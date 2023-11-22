@extends('layouts.dashboard')
@section('content')
    <div class="my-3">
        <h1>Edit Article</h1>
        <form action="{{route("article.update",$article->id)}}" method="POST">

            @csrf
            @method("put")
            <div class=" mb-3">
                <label for="" class=" form-label" >Article Title</label>
                <input value="{{old("title",$article->title)}}"  type="text" name="title" class=" form-control @error("title")
                 is-invalid
                @enderror">
                @error('title')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            <div class=" mb-3">
                <label for="" class=" form-label">Select Category</label>
                <select    name="category"
                    class=" form-select @error('category')
                is-invalid
                @enderror">
                    @foreach (App\Models\Category::all() as $category)
                        <option
                        {{old("category",$article->category_id) == $category->id ? "selected" : ""}}
                         value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class=" mb-3">
                <label for="" class=" form-label" >Description</label>
                <textarea  name="description" id="" class=" form-control @error("description")
                 is-invalid
                @enderror"  rows="5">{{old("description",$article->description)}}</textarea>
                @error('description')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <button class=" btn btn-primary">Update Article</button>
        </form>
    </div>
@endsection
