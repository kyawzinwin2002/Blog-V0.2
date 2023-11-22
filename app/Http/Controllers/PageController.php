<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $articles = Article::when(request()->has("keyword"),function($query){
            $keyword = request()->keyword;
            $query->where("title","like","%$keyword%");
            $query->orWhere("description","like","%$keyword%");
        })->with(["user","category"])->latest("id")->paginate(10)->withQueryString();

        return view("Pages.home",compact("articles"));
    }

    public function dashboard()
    {
        return view("Pages.dashboard");
    }

    public function detail($slug)
    {
        $article = Article::where("slug",$slug)->first();
        
        return view("Pages.detail",compact("article"));
    }

    public function categorize($slug)
    {
        $category = Category::where("slug",$slug)->firstOrFail();

        return view("Pages.category",[
            "category" => $category,
            "articles" => $category->articles()->when(request()->has("keyword"),function($query){
                $query->where(function(Builder $builder){
                    $keyword = request()->keyword;
                    $builder->where("title","like","%$keyword%");
                    $builder->orWhere("description","like","%$keyword%");
                });
            })->when(request()->has("sort"),function($query){
                $sort = request()->sort ?? "asc";
                $query->orderBy("title",$sort);
            })->with(["user","category"])->latest("id")->paginate(10)->withQueryString()
        ]);
    }
}
