@extends('layouts.main')

@section('title', 'Deleted Book')

@section('content')
<h1>Deleted Book List</h1>


<div class="mt-5 d-flex justify-content-end">
    <a href="/books" class="btn btn-primary me-3">Back to Category</a>
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
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedBooks as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->book_code}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->category}}</td>
                <td>
                    <a href="/bookRestored/{{$item->slug}}">Restore</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection