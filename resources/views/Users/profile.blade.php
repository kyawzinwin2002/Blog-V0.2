@extends('layouts.dashboard')
@section('content')

@if (is_null(Auth::user()->email_verified_at))
<div class=" alert alert-info">
    You need to verify your account <a href="{{route("account.verify")}}">Here</a>.
</div>
@endif

<div class=" d-flex my-4 gap-5 align-items-start">
    {{-- Photo & Uploader --}}
    <div class=" d-flex flex-column">

    <img src="@if (is_null(Auth::user()->photo))
    {{asset("storage/photos/profile.jpg")}}
    @else
    {{asset('storage/photos/z9ya2O1TdBe1ivQmgJDWGxRhVxD9aMP1tdtSo26p.png')}}
    @endif" class="rounded-5" width="200" alt="">

    <div class=" mt-5">
        <h5>Upload Your Profile Picture</h5>
        <form action="{{route("users.photo")}}" method="POST" enctype="multipart/form-data" class="mt-3 input-group">
            @csrf
            @method("put")
            <input type="file" name="photo" placeholder="Choose Your Photo.." accept="image/png,image/jpg,image/jpeg">
            <button class=" btn btn-primary">Upload</button>
        </form>
    </div>
    </div>

    <div class=" d-flex flex-column gap-3 ">
        {{-- Name and Role --}}
       <div class=" d-flex gap-2">
        <h3>{{Auth::user()->name}}</h3>
        <div class=" badge bg-black d-flex align-items-center">
            <span>{{Auth::user()->role->name}}</span>
        </div>
       </div>
       {{-- Email  --}}
       <div class="">
        <h5>{{Auth::user()->email}}</h5>
       </div>
    </div>
</div>

@endsection
