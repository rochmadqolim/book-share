@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<h1>LAMAN USER</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="/unregistered" class="btn btn-primary me-3">Waiting Approval</a>
    <a href="#" class="btn btn-secondary">View Banned</a>
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
                    <a href="#">Banned</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection