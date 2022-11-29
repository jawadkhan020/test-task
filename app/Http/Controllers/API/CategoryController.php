<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\MOdels\Vehicle;
use Validator;
class CategoryController extends Controller
{

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categryList(Request $request)
    {
       
        try{

            $data = Category::select('id', 'name', 'created_at')->where('user_id', $request->user_id)->latest()->get();
            if (sizeof( $data)) {

                return response()->json([
                'code' => '200',
                'message' => 'Category List!',
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
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required'
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
                    Category::create($input);
                      $data = Category::select('id', 'name', 'created_at')->where('user_id', $request->user_id)->latest()->get();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Category successfully created!',
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
            'cat_id' => 'required|exists:categories,id',
            'name' => 'required'
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
                   
                      Category::where('id', $request->cat_id)->update(['name' => $request->name]);
                      $data = Category::select('id', 'name', 'created_at')->where('user_id', $request->user_id)->latest()->get();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Category successfully Updated!',
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
            'cat_id' => 'required|exists:categories,id',
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
                   
                    $data=   Category::find($request->cat_id);
                  
                    $check =Vehicle::where('cat_id', $request->cat_id)->first();
                    if ($check) {

                        return response()->json([
                            'code' => '201',
                            'message' => 'Category cannot  Deleted First delete all vehicle aganist this category!',  
                        ]);

                    }else{
                        $data->delete();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Category successfully deleted!',
                      
                ]);
            }

        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }
}
