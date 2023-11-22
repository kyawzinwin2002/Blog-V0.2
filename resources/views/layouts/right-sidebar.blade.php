<div class=" position-sticky" style=" top:40px">
    <div class="">
        <h5>Search Article</h5>
        <form action="">
            <div class=" input-group">
                <input value="{{ request()->keyword }}" type="text" name="keyword" class=" form-control">
                <button class=" btn btn-dark">Search</button>
            </div>
        </form>
    </div>
    <div class=" my-3">
        <h5>Cateogries</h5>
        <ul class=" list-group my-3">
            <a href="{{ route('page.home') }}" class=" list-group-item list-group-item-action">All Categories</a>
            @foreach (App\Models\Category::all() as $category)
                <a href="{{ route('page.categorize', $category->slug) }}"
                    class=" list-group-item list-group-item-action  text-dark">{{ $category->title }}</a>
            @endforeach
        </ul>
    </div>

    <div class="my-3">
        <h5>Recent Articles</h5>
        <ul class="list-group ">
            @foreach (App\Models\Article::latest('id')->limit(5)->get() as $article)
            <a href="{{route("page.detail",$article->slug)}}" class=" list-group-item list-group-item-action">
                {{$article->title}}
            </a>
            @endforeach
        </ul>
    </div>
</div>
