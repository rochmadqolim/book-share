@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<h1>Wellcome, {{Auth::user()->username}}</h1>

<div class="row mt-5">
    <div class="col-lg-4">
        <div class="card-data book">
            <div class="row">
                <div class="col-6"><i class="bi bi-book"></i></div>
                <div class="col-6 d-flex align-items-end flex-column justify-content-center">
                    <div class="desc">Book</div>
                    <div class="count">{{$book_count}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data category">
            <div class="row">
                <div class="col-6"><i class="bi bi-tags"></i></div>
                <div class="col-6 d-flex align-items-end flex-column justify-content-center">
                    <div class="desc">Category</div>
                    <div class="count">{{$category_count}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data user">
            <div class="row">
                <div class="col-6"><i class="bi bi-people"></i></div>
                <div class="col-6 d-flex align-items-end flex-column justify-content-center">
                    <div class="desc">User</div>
                    <div class="count">{{$user_count}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Book</th>
            <th>Actual Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rent_logs as $item)
            <tr class="{{ $item->actual_date == null ? '' : ($item->return_date < $item->actual_date ? 'text-bg-danger' : 'text-bg-success') }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->username }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->actual_date }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
    </div>

@endsection