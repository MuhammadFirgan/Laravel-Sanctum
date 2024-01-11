<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::latest()->get();


        return response()->json([
            'status' => true,
            'message' => 'Data Found',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|max:255|unique:categories'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add new data',
                'data' => $validatedData->errors()
            ], 401);
        }

        Category::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Success to add new data'
        ], 200);

        

    }

    /**
     * Display the specified resource.
     */
    
    public function show(Category $category)
    {
        //
        try {
            $data = Category::findOrFail($category->id);

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'data' => $data
            ], 200);

        } catch(ModelNotFoundException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $e->getMessage() 
            ], 404);
        }
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|max:255|unique:categories'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add new data',
                'data' => $validatedData->errors()
            ], 401);
        }

        try {
            $data = Category::findOrFail($category->id);
            $data->update($request->all());
    
            return response()->json([
                'status' => true,
                'message' => 'Data updated successfully',
                'data' => $data
            ], 200);
    
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        try {
            $data = Category::findOrFail($category->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Delete Success',
                'data' => $data
            ], 200);

        } catch(ModelNotFoundException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $e->getMessage() 
            ], 404);
        }
    }
}
