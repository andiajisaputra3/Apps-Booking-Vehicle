<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicle.vehicle-action', ['vehicle' => new Vehicle()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => [
                'required',
                'string',
                'unique:vehicles',
                'max:255',
                'regex:/^[A-Z]{1,2}\s[0-9]{1,4}\s[A-Z]{0,3}$/'
            ],
        ]);

        $vehicle = new Vehicle;
        $vehicle->name = $request->name;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicle.vehicle-action', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => [
                'required',
                'string',
                'unique:vehicles,plate_number,' . $vehicle->id,
                'max:255',
                'regex:/^[A-Z]{1,2}\s[0-9]{1,4}\s[A-Z]{0,3}$/'
            ],
            'status' => [
                'required',
                'string',
                'in:tersedia,sedang digunakan,perbaikan'
            ],
        ]);

        $vehicle->name = $request->name;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->status = $request->status;
        $vehicle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle deleted successfully',
        ]);
    }
}