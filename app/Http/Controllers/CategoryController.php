<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
          'categories' => Category::all(),
        ]);
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
      $request->validate([
        'category_name' => 'required|unique:categories',
      ]);

       $return = Category::create($request->except('_token') + ['added_by' => Auth::id(), 'created_at' => Carbon::now()]);

       if($request->hasFile('category_image'))
       {
         $uploaded_image = $request->file('category_image');
         $filename = $return->id. '.' .$uploaded_image->extension('category_image');
         $location = public_path('uploads/category/' .$filename);
         Image::make($uploaded_image)->resize(600,470)->save($location);
         $return->category_image = $filename;
         $return->save();
       }



       return back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

      return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

      $allowed = ['jpg', 'png', 'jpeg'];
      $uploaded_image = $request->file('category_image');

       if($request->hasFile('category_image'))
       {
         if($uploaded_image->extension('category_image') == $allowed){
           if($category->category_image != 'category_default_image.jpg')
           {
             $existing_image = public_path('uploads/category/'. $category->category_image);
             unlink($existing_image);
           }
           $uploaded_image = $request->file('category_image');
           $filename = $category->id. '.' .$uploaded_image->extension('category_image');
           $location = base_path('public/uploads/category/' . $filename);
           Image::make($uploaded_image)->resize(600, 470)->save($location);
           $category->category_image = $filename;
         }
         else{
          return back()->with('hobena', 'File not supported');
         }
       }
       $category->category_name = $request->category_name;
       $category->save();
       return redirect('/category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
      $category->delete();
      $existing_image = public_path('uploads/category/'. $category->category_image);
      unlink($existing_image);
      return back();
    }

}
