<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingInvoiceController extends Controller
{
    public function download(Booking $booking)
    {
        // 🔐 Security
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Load relasi penting
        $booking->load([
            'room',
            'room.property',
            'user',
        ]);

        $pdf = Pdf::loadView('booking.invoice', [
            'booking' => $booking,
        ])->setPaper('A4');

        return $pdf->download(
            'Invoice-' . $booking->booking_code . '.pdf'
        );
    }
}
