@extends('layouts.main')

@section('title', 'Profile')

@section('content')
<div class="mt-5">
    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Book</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Actual Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rent_logs as $item)
            <tr class="{{ $item->actual_date == null ? '' : ($item->return_date < $item->actual_date ? 'text-bg-danger' : 'text-bg-success') }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->username }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->rent_date }}</td>
                <td>{{ $item->return_date }}</td>
                <td>{{ $item->actual_date }}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
    </div>
@endsection