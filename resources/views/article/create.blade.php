@extends('layouts.dashboard')
@section('content')
    <div class="row my-3">
        <div class="col-12">
            <h3>Create New Article</h3>
            <hr>
            <form action="{{ route('article.store') }}" method="POST">
                @csrf
                <div class=" mb-3">
                    <label for="" class=" form-label">Article Title</label>
                    <input value="{{ old('title') }}" type="text" name="title"
                        class=" form-control @error('title')
                    is-invalid
                    @enderror">
                    @error('title')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class=" form-label">Category</label>
                    <select name="category" id="" class=" form-select">
                        @foreach (App\Models\Category::all() as $category)
                        <option {{old("category") == $category->id ? "selected" : ""}} value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" mb-3">
                    <label for="" class=" form-label">Description</label>
                    <textarea name="description" id="" class=" form-control @error('description')
                    is-invalid
                    @enderror"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class=" btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
