<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Vehicle;
use Auth;
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Category::where('user_id', Auth::user()->id)->latest()->get();
        $vehicle =Vehicle::where('user_id', Auth::user()->id)->latest()->get();
        return view('admin.vehicle.index', compact('data', 'vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        if($request->hasFile('images'))
        {
            $fileNameWithExt = $request->file('images')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('images')->getClientOriginalExtension();
            $images = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('images')->storeAs('vehicle', $images);
            $input['images'] = $images;
        }
        Vehicle::create($input);
        return back()->with("status", "Vehicle successfully Store!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Vehicle::find($request->id);

        if($request->has('name')){
         $data->name= $request->name;
         }
         if($request->has('cat_id')){
            $data->cat_id= $request->cat_id;
            }
          if($request->has('brand')){
         $data->brand= $request->brand;
         }
          if($request->has('model')){
         $data->model= $request->model;
         }
         if($request->has('color')){
            $data->color= $request->color;
            }
            if($request->has('registration_no')){
                $data->registration_no= $request->registration_no;
                }
                if($request->hasFile('images'))
                {
                    $fileNameWithExt = $request->file('images')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('images')->getClientOriginalExtension();
                    $images = $fileName.'_'.time().'.'.$extension;
                    $path = $request->file('images')->storeAs('vehicle', $images);
                    $data['images'] = $images;
                }
        $data->save();

   return back()->with('status', 'Vehicle  updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vehicle::find($id);
        $data->delete();
        return ['success' => true, 'message' => 'New user created !!'];
    }
}
