<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background: #f5f5f5;
            text-align: left;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">INVOICE BOOKING</div>
        <p>Kode Booking: <strong>{{ $booking->booking_code }}</strong></p>
        <p>Tanggal Cetak: {{ now()->format('d F Y') }}</p>
    </div>

    <table>
        <tr>
            <th>Nama Tamu</th>
            <td>{{ $booking->user->name }}</td>
        </tr>
        <tr>
            <th>Hotel</th>
            <td>{{ $booking->room->property->name }}</td>
        </tr>
        <tr>
            <th>Kamar</th>
            <td>{{ $booking->room->room_name }}</td>
        </tr>
        <tr>
            <th>Check-in</th>
            <td>{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Check-out</th>
            <td>{{ \Carbon\Carbon::parse($booking->checkout_date)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Total Malam</th>
            <td>
                {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} malam
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Total Bayar</th>
            <td class="right total">
                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ strtoupper($booking->booking_status) }}</td>
        </tr>
    </table>

    <p style="margin-top: 30px; font-size: 11px;">
        Invoice ini sah dan diterbitkan secara elektronik oleh sistem RedStay.
    </p>

</body>

</html>
