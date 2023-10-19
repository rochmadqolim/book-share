@extends('layouts.main')

@section('title', 'Users')

@section('content')
<h1>Waiting Approval</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="/userList" class="btn btn-primary me-3">User List</a>
</div>
<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <form action="activated" method="post">
                @csrf
                @foreach ($users as $item)
                <tr>
                    <input type="hidden" name="slug" value="{{ $item->slug }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="/user/{{ $item->slug }}">Detail</a>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Activate</button>
                    </td>
                </tr>
                @endforeach
            </form>
            
        </tbody>
    </table>
</div>
@endsection