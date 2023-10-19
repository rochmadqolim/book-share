@extends('layouts.main')

@section('title', 'Category')

@section('content')
<h1>Category List</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="categoryAdd" class="btn btn-primary me-3">Add Category</a>
    <a href="categoryRestore" class="btn btn-secondary">Restore Category</a>
</div>

<div class="mt-5 text-center">
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
</div>

<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $item)
    <tr>
        <form action="">
            @csrf
            <input type="hidden" name="slug" value="{{ $item->slug }}">
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>
                <button type="submit" formaction="categoryUpdate/{{$item->slug}}" class="btn btn-primary">Edit</button>
                <button type="submit" formaction="categoryDeleted/{{$item->slug}}" class="btn btn-danger">Delete</button>
            </td>
        </form>
    </tr>
@endforeach


  
            
        </tbody>
    </table>
</div>
@endsection