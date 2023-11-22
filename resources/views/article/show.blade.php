@extends('layouts.dashboard')
@section('content')
    <div class="my-3">
        <h4 class="">Article Detail
        </h4>
        <div class="mb-3">
            <a href="{{ route('article.create') }}" class=" btn btn-outline-dark">Create</a>
            <a href="{{ route('article.index') }}" class=" btn btn-outline-dark">List</a>
        </div>
        <hr>

        <div class=" d-flex justify-content-between">
            <div class="">
                <h5>{{ $article->title }}</h5>
                <div class="">
                    <span class=" badge bg-black">{{$article->category->title}}</span>
                </div>
            </div>
            <h6>{{ $article->created_at->diffforhumans() }}</h6>
        </div>

        <div class="">
            {{-- {{ $article->description }} --}}
            {{!! e(nl2br($article->description)) !!}}
        </div>



        <div class=" d-flex  justify-content-between">
            <div class=" text-bold">
                Author : {{ $article->user->name ?? "Unknown" }}
            </div>
            <div class=" d-flex gap-3 align-items-center ">
                <i class="bi bi-hand-thumbs-up"></i>
                <i class="bi bi-chat-left-dots-fill"></i>
                <i class="bi bi-share-fill"></i>
            </div>
        </div>
        <hr>
    </div>
@endsection
