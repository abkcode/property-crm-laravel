<?php

namespace App\Http\Controllers;

use App\Jobs\FetchProperty;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Image;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Property::with('propertyType')->paginate();
    }

    /**
     * Display the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $property = Property::where('id', $id)->first();
        if ($property === null) {
            return response()->json([
                'message' => 'Property not found',
            ], 404);
        }

        return [
            'property' => $property,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        FetchProperty::dispatch();

        return [
            'message' => 'properties will be fetched in few minutes'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "county"=> ['required', 'max:255'],
            "country"=> ['required', 'max:255'],
            "town"=> ['required', 'max:255'],
            "postcode"=> ['required', 'integer'],
            "description"=> ['required', 'max:255'],
            "address"=> ['required', 'max:255'],
            "num_bedrooms"=> ['required', 'integer'],
            "num_bathrooms"=> ['required', 'integer'],
            "price"=> ['required', 'integer'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'type' => ['required', Rule::in(0, 1)],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        // $imagePath = $request->file('image')->store('image', 'public');

        $image = $request->file('image');
        $fileName = uniqid() . '_' . time() . '.' . $image->extension();
        $storagePath = storage_path('app/public/image');

        $thumbnailDir = 'thumb';
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($const) {
            $const->aspectRatio();
        })->save($storagePath . '/' . $thumbnailDir . '/' . $fileName);

        $fullImageDir = 'full';
        $image->move($storagePath . '/' . $fullImageDir, $fileName);

        $property = Property::create([
            "county" => $request->county,
            "country" => $request->country,
            "town" => $request->town,
            "postcode" => $request->postcode,
            "description" => $request->description,
            "address" => $request->address,
            "num_bedrooms" => $request->num_bedrooms,
            "num_bathrooms" => $request->num_bathrooms,
            "price" => $request->price,
            'property_type_id' => $request->property_type_id,
            'type' => $request->type,
            'image_full' => $thumbnailDir . '/' . $fileName,
            'image_thumbnail' => $fullImageDir . '/' . $fileName,
        ]);

        return [
            'message' => 'Property created succesfully',
            'property' => $property,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            "county"=> ['required', 'max:255'],
            "country"=> ['required', 'max:255'],
            "town"=> ['required', 'max:255'],
            "postcode"=> ['required', 'integer'],
            "description"=> ['required', 'max:255'],
            "address"=> ['required', 'max:255'],
            "num_bedrooms"=> ['required', 'integer'],
            "num_bathrooms"=> ['required', 'integer'],
            "price"=> ['required', 'integer'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'type' => ['required', Rule::in(0, 1)],
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $property = Property::where('id', $id)->first();
        if ($property === null) {
            return response()->json([
                'message' => 'Property not found',
            ], 404);
        }
        if ($request->get('county')) {
            $property->county = $request->get('county');
        }
        if ($request->get('country')) {
            $property->country = $request->get('country');
        }
        if ($request->get('town')) {
            $property->town = $request->get('town');
        }
        if ($request->get('postcode')) {
            $property->postcode = $request->get('postcode');
        }
        if ($request->get('description')) {
            $property->description = $request->get('description');
        }
        if ($request->get('address')) {
            $property->address = $request->get('address');
        }
        if ($request->get('num_bedrooms')) {
            $property->num_bedrooms = $request->get('num_bedrooms');
        }
        if ($request->get('num_bathrooms')) {
            $property->num_bathrooms = $request->get('num_bathrooms');
        }
        if ($request->get('price')) {
            $property->price = $request->get('price');
        }
        if ($request->get('property_type_id')) {
            $property->property_type_id = $request->get('property_type_id');
        }
        if ($request->get('type')) {
            $property->type = $request->get('type');
        }
        if ($request->file('image')) {
            $image = $request->file('image');
            $fileName = uniqid() . '_' . time() . '.' . $image->extension();
            $storagePath = storage_path('app/public/image');

            $thumbnailDir = 'thumb';
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($const) {
                $const->aspectRatio();
            })->save($storagePath . '/' . $thumbnailDir . '/' . $fileName);

            $fullImageDir = 'full';
            $image->move($storagePath . '/' . $fullImageDir, $fileName);

            $property->image_full = $thumbnailDir . '/' . $fileName;
            $property->image_thumbnail = $fullImageDir . '/' . $fileName;
        }
        if (!$property->save()) {
            return response()->json([
                'message' => 'Failed to update the property',
            ], 500);
        }

        return [
            'message' => 'Property updated succesfully',
            'property' => $property,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $property = Property::where('id', $id)->first();
        if ($property === null) {
            return response()->json([
                'message' => 'Property not found',
            ], 404);
        }
        if (!$property->delete()) {
            return response()->json([
                'message' => 'Failed to delete the property',
            ], 500);
        }

        return [
            'message' => 'Property deleted succesfully',
        ];
    }
}
