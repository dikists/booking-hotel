<?php

namespace App\Http\Controllers\Public;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\RoomPriceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room.property')->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('booking.index', compact('bookings'));
    }
    public function create(Request $request)
    {
        /**
         * 1️⃣ Validasi input
         */
        $request->validate([
            'room_id'  => ['required', 'exists:rooms,id'],
            'checkin'  => ['required', 'date'],
            'checkout' => ['required', 'date', 'after:checkin'],
        ]);

        /**
         * 2️⃣ Ambil data kamar
         */
        $room = Room::with('property')->findOrFail($request->room_id);

        /**
         * 3️⃣ Hitung total malam (HOTEL STANDARD)
         */
        $checkin  = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);

        $totalNight = $checkin->diffInDays($checkout);

        /**
         * Safety check (harus > 0)
         */
        if ($totalNight <= 0) {
            abort(400, 'Tanggal menginap tidak valid');
        }

        /**
         * 4️⃣ Hitung harga (sementara pakai harga final)
         */
        $pricePerNight = RoomPriceService::getPrice($room);
        $totalPrice    = $totalNight * $pricePerNight;

        /**
         * 5️⃣ Return ke halaman booking detail
         */
        return view('booking.create', [
            'room'         => $room,
            'checkin'      => $checkin->toDateString(),
            'checkout'     => $checkout->toDateString(),
            'totalNight'   => $totalNight,
            'pricePerNight' => $pricePerNight,
            'totalPrice'   => $totalPrice,
        ]);
    }

    public function show(Booking $booking)
    {
        /**
         * Security check
         */
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('booking.show', [
            'booking' => $booking,
        ]);
    }

    public function store(Request $request)
    {
        /**
         * 1️⃣ Validasi request
         */
        $request->validate([
            'room_id'  => ['required', 'exists:rooms,id'],
            'checkin'  => ['required', 'date'],
            'checkout' => ['required', 'date', 'after:checkin'],
        ]);

        $checkin  = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);

        /**
         * 2️⃣ Ambil kamar
         */
        $room = Room::findOrFail($request->room_id);

        /**
         * 3️⃣ TRANSACTION (ANTI RACE CONDITION)
         */
        return DB::transaction(function () use ($room, $checkin, $checkout) {

            /**
             * 4️⃣ VALIDASI AVAILABILITY ULANG
             */
            $isAvailable = !Booking::where('room_id', $room->id)
                ->whereIn('booking_status', ['pending', 'paid', 'checkin'])
                ->where(function ($q) use ($checkin, $checkout) {
                    $q->where('checkin_date', '<', $checkout)
                        ->where('checkout_date', '>', $checkin);
                })
                ->exists();

            if (! $isAvailable) {
                abort(409, 'Kamar sudah tidak tersedia');
            }

            /**
             * 5️⃣ HITUNG TOTAL MALAM
             */
            $totalNight = $checkin->diffInDays($checkout);

            if ($totalNight <= 0) {
                abort(400, 'Tanggal tidak valid');
            }

            /**
             * 6️⃣ HITUNG HARGA
             */
            $pricePerNight = RoomPriceService::getPrice($room);
            $totalPrice    = $pricePerNight * $totalNight;

            /**
             * 7️⃣ CREATE BOOKING (HOLD 15 MENIT)
             */
            $booking = Booking::create([
                'booking_code'   => 'BK-' . now()->format('YmdHis') . rand(100, 999),
                'user_id'        => auth()->id(),
                'property_id'    => $room->property_id,
                'room_id'        => $room->id,
                'checkin_date'   => $checkin->toDateString(),
                'checkout_date'  => $checkout->toDateString(),
                'total_price'    => $totalPrice,
                'booking_status' => 'pending',
                'expired_at'     => now()->addMinutes(15),
            ]);

            /**
             * 8️⃣ REDIRECT KE PAYMENT
             */
            return redirect()->route('payment.create', $booking->id);
        });
    }
}
