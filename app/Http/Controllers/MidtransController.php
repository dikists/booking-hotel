<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK', $request->all());

        $signature = hash(
            'sha512',
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                config('midtrans.server_key')
        );

        if ($signature !== $request->signature_key) {
            \Log::error('Signature invalid');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $booking = Booking::where('booking_code', $request->order_id)->first();

        if (!$booking) {
            \Log::error('Booking not found');
            return response()->json(['message' => 'Booking not found'], 404);
        }

        if ($request->transaction_status === 'settlement') {
            DB::transaction(function () use ($booking, $request) {
                $booking->update([
                    'booking_status' => 'paid',
                ]);

                Payment::create([
                    'booking_id' => $booking->id,
                    'provider'   => 'midtrans',
                    'amount'     => $request->gross_amount,
                    'status'     => 'paid',
                    'payload'    => json_encode($request->all()),
                ]);
            });
        }

        return response()->json(['message' => 'OK']);
    }
}
