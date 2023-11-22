@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Article List</h3>
            <div class=" d-flex align-items-center gap-5">
                @if (request()->has("keyword"))
                <div class=" d-flex justify-content-between">
                    <p>Showing result by : {{request()->keyword}}</p>
                    <a href="{{route("article.index")}}" class=" text-dark">Show All</a>
                </div>
            @endif
            <form action="">
                <div class=" input-group">
                    <input value="{{ request()->keyword }}" type="text" name="keyword" class=" form-control">
                    <button class=" btn btn-dark">Search</button>
                </div>
            </form>
            </div>
        </div>
        <hr>


        <div class="mb-3">
            <a href="{{ route('article.create') }}" class=" btn btn-outline-dark">Create</a>
        </div>
        <table class=" table table-bordered">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>Article</th>
                    <th>Category</th>
                    @can('admin')

                    <th>Author</th>
                    @endcan

                    <th>Actions</th>
                    <th>Updated_at</th>
                    <th>Created_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }} <br>
                            <span class="small text-black-50">
                                {{ Str::limit($article->description, 50, '...') }}

                            </span>
                        </td>
                        
                        <td>{{$article->category?->title ?? "Unknown"}}</td>

                        @can('admin')
                        <td>{{ $article->user?->name ?? "Unknown"}}</td>
                        @endcan

                        <td>
                            <div class="btn-group">
                                <a href="{{ route('article.show', $article->id) }}" class=" btn btn-outline-dark">
                                    Info
                                </a>

                                @can('delete', $article)
                                <button form="articleDeleteForm{{ $article->id }}" class=" btn btn-outline-dark">
                                    Del
                                </button>
                                @endcan

                                @can('update', $article)
                                <a href="{{ route('article.edit', $article->id) }}" class=" btn btn-outline-dark">
                                    Edit
                                </a>
                                @endcan



                            </div>

                            <form id="articleDeleteForm{{ $article->id }}" class=" d-inline-block"
                                action="{{ route('article.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                        <td>
                            <p class=" small m-0">

                                {{ $article->updated_at->format('d M Y') }}
                            </p>
                            <p class=" small m-0">

                                {{ $article->updated_at->format('h:i a') }}

                            </p>
                        </td>
                        <td>
                            <p class=" small m-0">

                                {{ $article->created_at->format('d M Y') }}
                            </p>
                            <p class=" small m-0">

                                {{ $article->created_at->format('h:i a') }}

                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class=" text-center">
                            There is no record <br>
                            <a href="{{ route('article.create') }}" class=" btn btn-primary">Create</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="">
        {{{$articles->onEachSide(1)->links()}}}

        </div>
    </div>
</div>
@endsection
