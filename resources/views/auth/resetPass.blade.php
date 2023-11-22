@extends('layouts.app')
@section('content')
<div class=" container">
    <div class="row justify-content-center">
        <h1>Reset Password</h1>
        <form action="{{route("password.update")}}" method="POST">
            @csrf
            <input type="hidden" name="user_token" value="{{$user_token}}">
            <div class=" my-3">
                <label for="" class=" form-label">New Password</label>
                <input type="password" class=" form-control @error("password")
                    is-invalid
                @enderror" name="password" placeholder="Enter Your Password">
                @error('password')
                    <div class=" invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class=" my-3">
                <label for="" class=" form-label">Confirm Password</label>
                <input type="password" class=" form-control @error("password")
                is-invalid
            @enderror" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <div class=" invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="my-3">
                <button class=" btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
