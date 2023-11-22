@extends('layouts.dashboard')
@section('content')
    <div class=" my-3">
        <h4>Enter Your Verification Code</h4>
        <form action="{{route("verify.check")}}" method="POST" class=" input-group w-50">
            @csrf
            <input type="text"  name="verify_code" class=" form-control @error('verify_code')
            is-invalid
            @enderror" placeholder="Enter Your Code">

            <button class=" btn btn-primary">Submit</button>
            @error('verify_code')
                <div class=" invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </form>
    </div>
@endsection
