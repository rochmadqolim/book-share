@extends('layouts.main')

@section('title', 'Banned User')

@section('content')
<h1>User Deleted</h1>

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
            @foreach($usersbanned as $item)
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
                    <a href="/userRestore/{{ $item->slug }}">Restore</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection