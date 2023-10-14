@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="my-5">
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/blank.jpg') }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->book_code }}</p>
                            <p class="card-text text-end fw-bold {{ $item->status == 'in stock'? 'text-success': 'text-danger' }}" >{{ $item->status }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection