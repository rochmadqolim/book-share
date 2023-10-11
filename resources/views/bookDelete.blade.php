@extends('layouts.main')

@section('title', 'Delete Book')

@section('content')
<h1>Are you sure to delete book {{$book->title}}?</h1>
<div class="mt-5">
    <a href="/bookDestroy/{{$book->slug}}" class="btn btn-danger me-5">Yes</a>
    <a href="/books" class="btn btn-primary">Cancel</a>
</div>
@endsection