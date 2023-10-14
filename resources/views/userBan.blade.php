@extends('layouts.main')

@section('title', 'Banned User')

@section('content')
<h1>Are you sure to banned user {{$user->username}}?</h1>
<div class="mt-5">
    <a href="/userBanned/{{$user->slug}}" class="btn btn-danger me-5">Yes</a>
    <a href="/users" class="btn btn-primary">Cancel</a>
</div>
@endsection