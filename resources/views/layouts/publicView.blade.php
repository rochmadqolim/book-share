@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<form action="" method="GET">
    <div class="row">

        {{-- <div class="card-body">
            @foreach ($categories as $item)
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="category" id="category" value="{{ $item->id }}">
                <span class="custom-control-label">{{ $item->name }}</span>
            </label>
            @endforeach
        </div> --}}


        <div class="col-12 col-sm-6">
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-12 col-sm-6">
            <div class="input-group mb-3">
                <input type="text" name="title" class="form-control" placeholder="Book Title">
                <button class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</form>

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