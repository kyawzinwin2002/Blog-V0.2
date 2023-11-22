@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row justify-content-center my-3">
            <div class=" text-center">
                <h1>Forget Password ?</h1>
            </div>
            <form action="{{route("email.check")}}" method="POST" class=" input-group py-3 w-50">
                @csrf
                <input type="email" placeholder="Enter Your Email" name="email" class=" @error("email")
                is-invalid
                @enderror form-control ">
                <button class=" btn btn-primary">Summit</button>
                @error('email')
                <div class=" invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </form>
        </div>
    </div>
@endsection
