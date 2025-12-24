<?php

namespace App\Http\Controllers\Partner;

use App\Models\Property;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyGallery;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Property::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function index()
    {
        $title = "Daftar Hotel/Properti ";
        $properties = Property::with(['province', 'city', 'district'])
            ->where('partner_id', auth()->id())
            ->get();
        return view('partner.hotel.index', compact('title', 'properties'));
    }

    public function create()
    {
        $title = "Tambah Hotel/Properti ";
        $provinces = Province::orderBy('province_name')->get();
        return view('partner.hotel.create', compact('title', 'provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
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
            'city_id'     => $validated['city_id'],
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
}
