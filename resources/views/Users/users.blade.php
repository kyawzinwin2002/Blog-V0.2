@extends('layouts.dashboard')
@section('content')
    <div class=" my-3">

        <h3>User List</h3>
        <table class=" table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Articles</th>
                    <th>Categories</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->articles->count()}}</td>
                    <td>{{$user->categories->count()}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>
                        <div class=" d-flex gap-2">
                            {{-- Change Role Dropdown --}}
                            @can("changeRole",$user)
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Change Role
                                </button>
                                <ul class="dropdown-menu">
                                <li>
                                    <form action="{{route("users.role")}}" method="POST">
                                        @csrf
                                        @method("put")
                                        <input type="hidden" value="2" name="role_id">
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        <button class="dropdown-item">Administrator</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{route("users.role")}}" method="POST">
                                        @csrf
                                        @method("put")

                                        <input type="hidden" value="1" name="role_id">
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        <button class="dropdown-item">User</button>
                                    </form>
                                </li>
                                </ul>
                            </div>
                            @endcan
                              {{-- Active Suspend --}}
                              @can('suspend', $user)

                              @if ($user->suspended)
                              <form action="{{route("users.active")}}" method="POST" class=" d-inline-block">
                                @csrf
                                @method("put")
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button class=" btn btn-danger">Suspended</button>
                              </form>

                              @else
                              <form action="{{route("users.ban")}}" method="POST" class=" d-inline-block">
                                @csrf
                                @method("put")
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button class=" btn btn-success">Active</button>
                              </form>


                              @endif
                              @endcan

                              @can('delete', $user)
                              {{-- Delete User --}}
                              <form action="{{route("users.destroy",["id" => $user->id])}}" class=" d-inline-block" method="POST">
                                @csrf
                                @method("delete")
                                <button class=" btn btn-outline-danger">Del</button>
                              </form>
                              @endcan

                        </div>
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class=" text-center">
                            <h4>There is no user!</h4>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="">
            {{$users->onEachSide(1)->links()}}
        </div>
    </div>
@endsection
