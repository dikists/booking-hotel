<?php

namespace App\Http\Controllers\Partner;

use App\Models\Room;
use App\Models\Property;
use App\Models\RoomGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RoomGalleryController extends Controller
{
    public function index(Property $property, Room $room)
    {
        $title = "Galeri Kamar";
        abort_if($room->property_id !== $property->id, 404);

        return view('partner.rooms.gallery.index', [
            'title'     => $title,
            'property'  => $property,
            'room'      => $room,
            'galleries' => $room->galleries,
        ]);
    }

    public function store(Request $request, Property $property, Room $room)
    {
        // pastikan room milik property
        abort_if($room->property_id !== $property->id, 404);

        $request->validate([
            'images'   => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $maxSort = $room->galleries()->max('sort_order') ?? 0;
        $isFirst = $room->galleries()->count() === 0;

        foreach ($request->file('images') as $index => $image) {

            $path = $image->store('rooms', 'public');

            RoomGallery::create([
                'room_id'    => $room->id,
                'image'      => $path,
                'sort_order' => $maxSort + $index + 1,
                'is_primary' => $isFirst && $index === 0, // foto pertama jadi utama
            ]);
        }

        return back()->with('success', 'Foto room berhasil diupload');
    }

    public function setPrimary(
        Property $property,
        Room $room,
        RoomGallery $gallery
    ) {
        // Validasi relasi
        abort_if($room->property_id !== $property->id, 404);
        abort_if($gallery->room_id !== $room->id, 404);

        DB::transaction(function () use ($room, $gallery) {

            // 1. Reset semua foto room
            $room->galleries()->update([
                'is_primary' => false
            ]);

            // 2. Set foto terpilih
            $gallery->update([
                'is_primary' => true
            ]);
        });

        return back()->with('success', 'Foto utama berhasil diubah');
    }

    public function destroy($propertyId, $roomId, RoomGallery $gallery)
    {
        // Pastikan gallery milik room yang benar
        abort_if($gallery->room_id != $roomId, 403);

        // Hapus file fisik
        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        // Jika foto utama dihapus → set primary baru
        if ($gallery->is_primary) {
            $nextPrimary = RoomGallery::where('room_id', $roomId)
                ->where('id', '!=', $gallery->id)
                ->orderBy('sort_order')
                ->first();

            if ($nextPrimary) {
                $nextPrimary->update(['is_primary' => true]);
            }
        }

        $gallery->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}
