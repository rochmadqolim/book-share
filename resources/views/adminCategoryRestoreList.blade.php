@extends('layouts.main')

@section('title', 'Deleted Category')

@section('content')
<h1>Deleted List</h1>


<div class="mt-5 d-flex justify-content-end">
    <a href="/categoryList" class="btn btn-primary me-3">Back to Category</a>
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
            @foreach($deletedCategories as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>
                    <a href="categoryRestored/{{$item->slug}}">Restore</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection