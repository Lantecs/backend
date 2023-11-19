<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CarouselItemsRequest;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarouselItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarouselItems::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarouselItemsRequest $request)
    {

        $validated = $request->validated();

        $carouselItem = CarouselItems::create($validated);

        return $carouselItem;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carouselItem = CarouselItems::findOrFail($id);

        return $carouselItem;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CarouselItemsRequest $request, string $id)
    {

        $validated = $request->validated();

        $carouselItem = CarouselItems::findOrFail($id);

        $carouselItem->update($validated);

        return $carouselItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $carouselItem = CarouselItems::findOrFail($id);
            $carouselItem->delete();

            return response()->json(['message' => 'Resource deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete resource'], 500);
        }
    }
}
