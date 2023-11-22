<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(Auth::user()->role->name === "user",function($query){
            $query->where("user_id",Auth::id());
        })->when(request()->has("keyword"),function($query){
           $query->where(function(Builder $builder){
            $keyword = request()->keyword;
            $builder->where("title","like","%$keyword%");
            $builder->orWhere("description","like","%$keyword%");
           });
        })->with(["user","category"])->latest("id")
        ->paginate(7)
        ->withQueryString();

        return view("article.index",compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("article.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $title = $request->title;
        $description = $request->description;

        Article::create([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $description,
            "excerpt" => Str::words($description, 40, '...'),
            "category_id" => $request->category,
            "user_id" => Auth::id()
        ]);

        return redirect()->route("article.index")->with("message","Article Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view("article.show",compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize("update",$article);

        return view("article.edit",compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize("update",$article);

        $article->update([
            "title" => $request->title,
            "category_id" => $request->category,
            "description" => $request->description
        ]);

        return redirect()->route("article.index")->with("message",$article->title." is updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize("delete",$article);

        $article->delete();
        
        return redirect()->back()->with("message","Article Deleted Successfully");
    }
}
