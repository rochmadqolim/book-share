@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<h1>LAMAN USER</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="/userAdd" class="btn btn-primary me-3">Added User</a>
    <a href="/unActivatedList" class="btn btn-primary me-3">Activated User</a>
    <a href="/bannedList" class="btn btn-secondary">Banned List</a>
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
                <th>Username</th>
                <th>Phone</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->username}}</td>
                <td>{{ $item->phone }}</td>
                <td>
                    <a class="btn btn-primary" href="/user/{{ $item->slug }}">Detail</a>
                    <a class="btn btn-danger" href="/userBann/{{ $item->slug }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection