@extends('layouts.home')
@section('content')
<div class="my-3">
    <div class="">

        @if (request()->has("keyword"))
            <div class=" d-flex justify-content-between">
                <p>Showing result by : {{request()->keyword}}</p>
                <a href="{{route("page.home")}}" class=" text-dark">Show All</a>
            </div>
        @endif

        @if (request()->has("category"))
            <div class=" ">
                <p>Article categorize by : {{request()->category}}</p>
                <a href="{{route("page.home")}}" class=" text-dark">Show All</a>
            </div>
        @endif

        @forelse ($articles as $article)
        <div class="card mb-5 p-3 rounded">
            <div class=" d-flex justify-content-between">
                <h3>
                    <a href="" class=" text-decoration-none text-dark">
                       {{$article->title}}
                    </a>
                </h3>
                <div class="">
                    <span class=" badge bg-dark">
                        {{$article->created_at->format("d M Y")}}
                    </span>
                </div>
            </div>
            <div class="mb-2" >

                    <span class=" badge bg-dark">{{$article->category?->title ?? "Unknown"}}</span>
                <span class=" badge bg-dark">{{$article->user?->name ?? "Unknown"}}</span>



            </div>
            <p>{{$article->excerpt}}</p>
            <div class="">
                <a href="{{route('page.detail',$article->slug)}}" class=" btn btn-dark">See More</a>
            </div>
        </div>

        @empty

        <div class=" card">
            <div class="card-body text-center">
                <h3>There is no article!</h3>
                <a href="{{route("register")}}" class=" btn btn-dark">Try Now</a>
            </div>
        </div>

        @endforelse

    </div>
    <div class="">
        {{$articles->onEachSide(1)->links()}}
    </div>
</div>
@endsection
