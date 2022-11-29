<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\MOdels\Vehicle;
use Validator;
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vehicleList(Request $request)
    {
        try{

            $data = Vehicle::where('user_id', $request->user_id)->latest()->with('category:id,name')->get();
            if (sizeof( $data)) {

                return response()->json([
                'code' => '200',
                'message' => 'Vehicle List!',
                'data' =>$data,   
            ]);
        }else{
            return response()->json([
                'code' => '201',
                'message' => 'Data Not Exist', 
            ]);

        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'images' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'registration_no' => 'required',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{
                   
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
                      $data = Vehicle::where('user_id', $request->user_id)->latest()->with('category:id,name')->get();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Vehicle successfully Store!',
                    'data' =>$data,   
                ]);


        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:vehicles,id',
            'name' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'images' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'registration_no' => 'required',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{
                   
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
                $data = Vehicle::where('user_id', $request->user_id)->latest()->with('category:id,name')->get();
            return response()->json([
            'code' => '200',
            'message' => 'Vehicle successfully Updated!',
            'data' =>$data,   
        ]);


        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:vehicles,id',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{
                   
                    $data=   Vehicle::find($request->id);
                  
                    $data->delete();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Vehicle successfully deleted!',
                      
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }
    
}
