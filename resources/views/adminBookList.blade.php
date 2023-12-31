@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<h1>BOOK LIST</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="bookAdd" class="btn btn-primary me-3">Add Book</a>
    <a href="bookRestore" class="btn btn-secondary">Deleted List</a>
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
                <th>Cover</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >
            @foreach($books as $item)
            <tr >
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/blank.jpg') }}" class="img-thumbnail" >
                </td>
                <td>{{$item->book_code}}</td>
                <td>{{$item->title}}</td>
                <td>
                    @foreach ($item->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </td>
                <td class="fw-bold {{ $item->status == 'in stock'? 'text-success': 'text-danger' }}" >{{$item->status}}</td>
                <td>
                    <a href="/bookUpdate/{{ $item->slug }}">Update</a>
                    <a href="/bookDelete/{{ $item->slug }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection