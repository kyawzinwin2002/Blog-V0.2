@extends('layouts.dashboard')
@section('content')
    <div class=" my-3">

        <h3>Category List</h3>
        <table class=" table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Articles</th>
                    <th>Action</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->user->name}}</td>
                    <td>{{$category->articles->count()}}</td>
                    <td>
                       @can('update', $category)
                       <a href="{{route("category.edit",$category->id)}}" class=" btn btn-outline-dark">Edit</a>
                       @endcan

                       @can('delete', $category)
                       <form action="{{route("category.destroy",$category->id)}}" class="d-inline-block" method="POST">
                        @csrf
                        @method("delete")
                        <button class=" btn btn-outline-dark">Del</button>
                    </form>
                       @endcan

                    </td>

                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class=" text-center">
                            <h4>There is no cateogry!</h4>
                            <a href="{{route("category.create")}}" class=" btn btn-primary">Create</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="">
            {{$categories->onEachSide(1)->links()}}
        </div>
    </div>
@endsection
