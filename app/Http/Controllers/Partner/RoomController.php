<?php

namespace App\Http\Controllers\Partner;

use App\Models\Room;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RoomPriceService;


class RoomController extends Controller
{    
    public function index(Property $property)
    {
        $title = "Daftar Kamar";
        $rooms = $property->rooms()
            ->with('activePromo', 'primaryImage')
            ->get();

        return view('partner.rooms.index', [
            'title' => $title,
            'property' => $property,
            'rooms' => $rooms
        ]);
    }

    public function create(Property $property)
    {
        $title = "Tambah Kamar";
        return view('partner.rooms.create', [
            'title' => $title,
            'property' => $property
        ]);
    }

    public function store(Request $request, Property $property)
    {
        $validated = $request->validate([
            'room_name'  => 'required|string|max:255',
            'capacity'   => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'status'     => 'required|in:available,unavailable',
        ]);

        $property->rooms()->create($validated);

        return redirect()
            ->route('partner.hotels.rooms.index', $property->id)
            ->with('success', 'Room berhasil ditambahkan');
    }

    public function edit(Property $property, Room $room)
    {
        abort_if($room->property_id !== $property->id, 404);

        $title = "Edit Kamar";
        return view('partner.rooms.edit', [
            'title' => $title,
            'property' => $property,
            'room' => $room
        ]);
    }

    public function update(Request $request, Property $property, Room $room)
    {
        abort_if($room->property_id !== $property->id, 404);

        $validated = $request->validate([
            'room_name'  => 'required|string|max:255',
            'capacity'   => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'status'     => 'required|in:available,unavailable',
        ]);

        $room->update($validated);

        return redirect()
            ->route('partner.hotels.rooms.index', $property->id)
            ->with('success', 'Kamar berhasil diperbarui');
    }
}
