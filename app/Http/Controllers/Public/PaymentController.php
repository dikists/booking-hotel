<?php

namespace App\Http\Controllers\Public;

use Midtrans\Snap;
use App\Models\Booking;
use App\Models\Payment;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function create(Booking $booking)
    {
        /**
         * Security check
         */
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        /**
         * Booking harus pending
         */
        if ($booking->booking_status !== 'pending') {
            abort(404);
        }

        /**
         * Booking expired?
         */
        if ($booking->expired_at && now()->greaterThan($booking->expired_at)) {
            $booking->update(['booking_status' => 'cancel']);
            abort(410, 'Booking sudah kedaluwarsa');
        }

        $remainingSeconds = now()->diffInSeconds(
            Carbon::parse($booking->expired_at),
            false
        );

        return view('payment.create', [
            'booking' => $booking,
            'remainingSeconds' => $remainingSeconds,
        ]);
    }

    public function pay(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->booking_status !== 'pending') {
            abort(400);
        }

        if ($booking->expired_at < now()) {
            $booking->update(['booking_status' => 'cancel']);
            abort(410, 'Booking expired');
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'callbacks' => [
                'finish' => route('payment.finish', $booking->id),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }

    // public function finish(Request $request, Booking $booking)
    // {
    //     // JANGAN update status di sini
    //     return view('payment.finish', [
    //         'booking' => $booking,
    //         'transaction_status' => $request->transaction_status
    //     ]);
    // }

    // HANYA UNTUK DEVELOPMENT
    public function finish(Request $request, Booking $booking)
    {
        $orderId = $request->order_id;

        // ⚠️ JANGAN percaya URL
        $status = Transaction::status($orderId);

        // dd($status);

        if ($status->transaction_status === 'settlement') {

            DB::transaction(function () use ($booking, $status) {

                $booking->update([
                    'booking_status' => 'paid',
                    'expired_at' => null,
                ]);

                Payment::updateOrCreate(
                    ['booking_id' => $booking->id],
                    [
                        'payment_method' => $status->payment_type,
                        'payment_gateway_ref' => $status->transaction_id,
                        'amount' => $status->gross_amount,
                        'payment_status' => 'success',
                        'paid_at' => now(),
                    ]
                );
            });

            return view('payment.success', compact('booking'));
        }

        return view('payment.failed', compact('booking'));
    }
}
