<?php

namespace App\Http\Controllers\Partner;

use App\Models\Property;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{

    private function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (
            Property::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }


    public function index()
    {
        $title = "Daftar Hotel/Properti ";
        $properties = Property::with(['province', 'city', 'district', 'rooms'])
            ->where('partner_id', auth()->id())
            ->get();
        return view('partner.hotel.index', compact('title', 'properties'));
    }

    public function create()
    {
        $title = "Tambah Hotel/Properti ";
        $provinces = Province::orderBy('name')->get();
        return view('partner.hotel.create', compact('title', 'provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'province_id' => 'required|exists:reg_provinces,id',
            'regency_id' => 'required|exists:reg_regencies,id',
            'district_id' => 'required|exists:reg_districts,id',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gallery.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('properties/thumbnails', 'public');
        }

        $property = Property::create([
            'partner_id' => auth()->id(),
            'name'       => $validated['name'],
            'slug'       => $this->generateUniqueSlug($request->name),
            'address'    => $validated['address'],
            'province_id' => $validated['province_id'],
            'regency_id'     => $validated['regency_id'],
            'district_id' => $validated['district_id'],
            'status'     => 1,
            'thumbnail'  => $thumbnailPath,
        ]);

        // Upload gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('properties/gallery', 'public');

                PropertyGallery::create([
                    'property_id' => $property->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->route('partner.hotel.index')
            ->with('success', 'Hotel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $property = Property::with(['province', 'city', 'district', 'galleries'])
            ->where('partner_id', auth()->id())
            ->findOrFail($id);

        $provinces = Province::orderBy('name')->get();
        $title = "Edit Hotel/Properti";

        return view('partner.hotel.edit', compact('title', 'property', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::where('partner_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required',
            'province_id' => 'required|exists:reg_provinces,id',
            'regency_id' => 'required|exists:reg_regencies,id',
            'district_id' => 'required|exists:reg_districts,id',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gallery.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update thumbnail jika diganti
        if ($request->hasFile('thumbnail')) {
            if ($property->thumbnail) {
                Storage::disk('public')->delete($property->thumbnail);
            }

            $property->thumbnail = $request->file('thumbnail')
                ->store('properties/thumbnails', 'public');
        }

        // Update data utama
        $property->update([
            'name'        => $request->name,
            'slug'        => $this->generateUniqueSlug($request->name, $property->id),
            'address'     => $request->address,
            'province_id' => $request->province_id,
            'regency_id'     => $request->regency_id,
            'district_id' => $request->district_id,
            // 'status'      => $request->status,
        ]);

        // Tambah gallery baru (tidak hapus lama)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('properties/gallery', 'public');
                $property->galleries()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()
            ->route('partner.hotel.index')
            ->with('success', 'Properti berhasil diperbarui');
    }

    public function destroy($id)
    {
        $property = Property::where('partner_id', auth()->id())
            ->findOrFail($id);

        // Hapus thumbnail
        if ($property->thumbnail) {
            Storage::disk('public')->delete($property->thumbnail);
        }

        // Hapus gallery
        foreach ($property->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->delete();
        }

        $property->delete();

        return redirect()
            ->route('partner.hotel.index')
            ->with('success', 'Properti berhasil dihapus');
    }
}
