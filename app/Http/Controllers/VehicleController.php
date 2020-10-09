<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(3);

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'board' => ['required', 'unique:vehicles', 'max:8'],
            'model' => ['required', 'max:255'],
            'image' => ['mimes:jpeg,png,jpg', 'dimensions:min_width=200,min_height=200'],
        ]);
        $vehicle = new Vehicle($validatedData);
        $vehicle->user_id = Auth::id();
        $vehicle->save();

        if ($request->hasFile('image') and $request->file('image')->isValid()) {
            $path = $request->file('image')->store('vehicle');
            $image = new Image();
            $image->vehicle_id = $vehicle->id;
            $image->path = $path;
            $image->save();
        }

        return redirect('vehicles')->with('sucess', 'Vehicles sucessfullly created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle, Image $image)
    {
        Storage::disk('public')->delete($vehicle->image->path);
        // $vehicle->board = $request->board;
        // $vehicle->model = $request->model;
        // $vehicle->save();
        Image::where('id', $vehicle->image->id)->update(['path' => $request->file('image')->store('vehicle')]);
        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->user_id === Auth::id()) {
            $path = $vehicle->image->path;
            $vehicle->delete();
            Storage::disk('public')->delete($path);
            return redirect()->route('vehicles.index');
        }
    }
}
