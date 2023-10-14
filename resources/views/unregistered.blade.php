@extends('layouts.main')

@section('title', 'Users')

@section('content')
<h1>Waiting Approval</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="/users" class="btn btn-primary me-3">User List</a>
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
                <td>
                    @if ($item->phone)
                        {{ $item->phone }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="/user/{{ $item->slug }}">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection