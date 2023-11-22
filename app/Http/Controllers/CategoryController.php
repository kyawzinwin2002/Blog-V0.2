<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(["user","articles"])->paginate(10)->withQueryString();
        
        return view("category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $title = $request->title;

        Category::create([
            "title" => $title,
            "slug" => Str::slug($title),
            "user_id" => Auth::id()
        ]);

        return redirect()->route("category.index")->with("message","Successfully Created New Category");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("category.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validate([
            "title" => "required|string|min:3|max:50|unique:categories,title,$category->id"
        ]);

        $category->update([
            "title" => $request->title
        ]);

        return redirect()->route("category.index")->with("message","Successfully Updated Category");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with("message","Deleted Category Successfully!");
    }
}
