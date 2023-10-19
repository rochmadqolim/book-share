@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<h1>Wellcome, {{Auth::user()->username}}</h1>

<div class="mt-5 text-center">
    @if (session('message'))
    <div class="alert {{ session('alert-class') }}">
        {{session('message')}}
    </div>
    @endif
</div>

<div class="mt-5">
    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Book</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rent_logs as $item)
    <tr>
        <form action="rentList" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $item->user->id }}">
            <input type="hidden" name="book_id" value="{{ $item->book->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->username }}</td>
            <td>{{ $item->book->title }}</td>
            <td>{{ $item->rent_date }}</td>
            <td>{{ $item->return_date }}</td>
            <td>
                <button type="submit" class="btn btn-primary">Return</button>
            </td>
        </form>
    </tr>
@endforeach


    </tbody>
    </table>
    </div>

@endsection