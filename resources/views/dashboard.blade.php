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

<div>
    <h2>Rent Log</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Date</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" style="text-align: center;">No Data</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection