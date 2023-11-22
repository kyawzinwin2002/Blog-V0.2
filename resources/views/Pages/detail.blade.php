@extends('layouts.home')
@section('content')
    <div class=" card p-3">
        <div class=" d-flex justify-content-between">
            <h3>
                <a href="" class=" text-decoration-none text-dark">
                    {{ $article->title }}
                </a>
            </h3>
            <div class="">
                <span class=" badge bg-dark">
                    {{ $article->created_at->format('d M Y') }}
                </span>
            </div>
        </div>
        <div class="mb-2">

            <span class=" badge bg-dark">{{ $article->category?->title ?? 'Unknown' }}</span>
            <span class=" badge bg-dark">{{ $article->user?->name ?? 'Unknown' }}</span>



        </div>
        <div class="">
            <p class="p-0 m-0">{{ $article->description }}</p>
        </div>

    </div>

    @auth
        @include('layouts.comment')
    @endauth


@endsection
