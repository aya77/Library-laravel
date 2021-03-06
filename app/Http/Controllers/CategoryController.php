<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return CategoryResource::collection(Category::all());
        return new CategoryCollection(Category::paginate(15));
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
        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        if($category->save()){
            return new CategoryResource($category);
        }else{
            return response()->json([
                'msg' => 'error while saving',
            ]);
        }
    }

    /**
     * Display thephp artisan make:resource specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = new Category;
        $category=Category::findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update thphp artisan make:resourcee specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)

    {
        $category = new Category;
        $category=Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        if($category->save()){
            return new CategoryResource($category);
        }else{
            return response()->json([
                'msg' => 'error while updating',
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$category=Category::findOrFail($id);
        $category=Category::findOrFail($id);
        if($category->delete()){
            return new CategoryResource($category);
        }else{
            return response()->json([
                'msg' => 'error while deleting',
            ]);
        }
    }
}
