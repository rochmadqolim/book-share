@extends('layouts.main')

@section('title', 'Add Category')

@section('content')
<h1>Category Edit</h1>

<div class="mt-5 w-50">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <div>{{$error}}</div>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/categoryEdit/{{$category->slug}}" method="post">
        @csrf
        @method('put')
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}"
                placeholder="Category Name">
        </div>

        <div class="mt-3">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
</div>

@endsection