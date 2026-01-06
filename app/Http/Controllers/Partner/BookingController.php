<?php

namespace App\Http\Controllers\Partner;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $title = "Manajemen Bookingan";
        $partnerId = auth()->id();

        $bookings = Booking::with([
            'room.property',
            'user' // customer
        ])
            ->whereHas('room.property', function ($q) use ($partnerId) {
                $q->where('partner_id', $partnerId);
            })
            ->latest()
            ->get();

        return view('partner.booking.index', compact('bookings', 'title'));
    }

    public function overrideCheckin(Booking $booking)
    {
        // Pastikan booking milik partner ini
        if ($booking->room->property->partner_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->booking_status !== 'paid') {
            return back()->with('error', 'Booking tidak valid untuk check-in');
        }

        $booking->update([
            'booking_status' => 'checkin',
            'checkin_at'     => now(),
            'checkin_by'     => 'partner',
        ]);

        return back()->with('success', 'Customer berhasil check-in');
    }

    public function overrideCheckout(Booking $booking)
    {
        if ($booking->room->property->partner_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->booking_status !== 'checkin') {
            return back()->with('error', 'Booking belum check-in');
        }

        $booking->update([
            'booking_status' => 'checkout',
            'checkout_at'    => now(),
            'checkout_by'    => 'partner',
        ]);

        return back()->with('success', 'Customer berhasil check-out');
    }
}
