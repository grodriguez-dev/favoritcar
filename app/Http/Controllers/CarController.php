<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        $brands = Brand::all();
        return view('welcome', compact('cars', 'brands'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){

            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/cars/';        
            $file->move($path,$img);
        }

        $arg = [
            'name' => $request->name,
            'description' => $request->description,
            'year' => $request->year,
            'brand_id' => $request->brand_id,
            'image' => $img
        ];

        Car::create($arg);
        return redirect()->route('index.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_e = Car::where('id', $id)->first();
        $brands = Brand::all();
        $cars = Car::all();
        return view('welcome', compact('car_e', 'cars', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/cars/';        
            $file->move($path,$img);

            $image = public_path('/assets/cars/'.$request->hiddenimage);

            if (@getimagesize($image)) {

                unlink(public_path('/assets/cars/'.$request->hiddenimage));
            }

        } else {
            $img = $request->hiddenimage;
        }

        Car::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'year' => $request->year,
            'brand_id' => $request->brand_id,
            'image' => $img,
        ]);
        return redirect()->route('index.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::where('id', $id)->first();
        $car->delete();
        return redirect()->route('index.index');
    }
}
