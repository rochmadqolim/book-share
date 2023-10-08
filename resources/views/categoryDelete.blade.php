@extends('layouts.main')

@section('title', 'Delete Category')

@section('content')
<h1>Are you sure to delete category {{$category->name}}?</h1>
<div class="mt-5">
    <a href="/categoryDestroy/{{$category->slug}}" class="btn btn-danger me-5">Yes</a>
    <a href="/categories" class="btn btn-primary">Cancel</a>
</div>
@endsection