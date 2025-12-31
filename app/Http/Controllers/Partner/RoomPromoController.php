<?php

namespace App\Http\Controllers\Partner;

use App\Models\Room;
use App\Models\Property;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomPromoController extends Controller
{
    public function index(Property $property, Room $room)
    {
        abort_if($room->property_id !== $property->id, 404);

        $promos = Promotion::where('room_id', $room->id)
            ->orderBy('start_date')
            ->get();
        $title = "Daftar Promo Kamar";

        return view('partner.rooms.promos.index', compact(
            'title',
            'property',
            'room',
            'promos'
        ));
    }

    public function create(Property $property, Room $room)
    {
        abort_if($room->property_id !== $property->id, 404);

        $title = "Tambah Promo Kamar";

        return view('partner.rooms.promos.create', compact(
            'title',
            'property',
            'room'
        ));
    }

    public function store(Request $request, Property $property, Room $room)
    {
        abort_if($room->property_id !== $property->id, 404);

        $hasConflict = Promotion::where('room_id', $room->id)
            ->where('is_active', true)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q2) use ($request) {
                        $q2->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($hasConflict) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_date' => 'Tanggal promo bentrok dengan promo lain yang masih aktif',
                ]);
        }

        $data = $request->validate([
            'discount_type'  => 'required|in:percent,amount',
            'discount_value' => 'required|numeric|min:0',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'is_active'      => 'nullable|boolean',
        ]);

        $data['property_id'] = $property->id;
        $data['room_id']     = $room->id;
        $data['is_active']   = $request->boolean('is_active');

        Promotion::create($data);

        return redirect()
            ->route('partner.hotels.rooms.promos.index', [$property->id, $room->id])
            ->with('success', 'Promo berhasil ditambahkan');
    }
}
