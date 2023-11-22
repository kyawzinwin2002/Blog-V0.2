@extends('layouts.dashboard')
@section('content')
<div class="my-3">
    <h3>Edit Category</h3>
    <hr>
    <form action="{{route("category.update",$category->id)}}" method="POST">
        @csrf
        @method('put')
        <div class=" mb-3">
            <label for="" class=" form-label" >Category Title</label>
            <input value="{{old("title",$category->title)}}"  type="text" name="title" class=" form-control @error("title")
             is-invalid
            @enderror">
            @error('title')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
        </div>


        <button class=" btn btn-primary">Edit</button>
    </form>
</div>
@endsection
