@extends('layouts.dashboard')
@section('content')
    <div class=" my-3">
        <h3>Change Password</h3>
        <form action="{{route("changePass.check")}}" method="POST" class=" w-50">
            @csrf
            @method('put')
            <div class=" my-3">
                <label for="" class=" form-label">Current Password</label>
                <input type="password" name="current_password"
                    class=" @error('current_password')
                    is-invalid
            @enderror form-control">
                @error('current_password')
                    <div class=" invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" my-3">
                <label for="" class=" form-label">New Password</label>
                <input type="password" name="password"
                    class=" @error('password')
            is-invalid
    @enderror form-control">
                @error('password')
                    <div class=" invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" my-3">
                <label for="" class=" form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                    class=" @error('password_confirmation')
            is-invalid
    @enderror form-control">
                @error('password_confirmation')
                    <div class=" invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-3">
                <button class=" btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
@endsection
