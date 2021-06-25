<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
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
            $path = public_path() .'/assets/brands/';        
            $file->move($path,$img);
        }

        $arg = [
            'name' => $request->name,
            'image' => $img,
        ];

        Brand::create($arg);
        return redirect()->route('brands.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.create', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/brands/';        
            $file->move($path,$img);

            $image = public_path('/assets/brands/'.$request->hiddenimage);

            if (@getimagesize($image)) {

                unlink(public_path('/assets/brands/'.$request->hiddenimage));
            }

        } else {
            $img = $request->hiddenimage;
        }

        $brand->update([
            'name' => $request->name,
            'image' => $img
        ]);

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
       $brand->delete();
       return redirect()->route('brands.index');
    }
}
