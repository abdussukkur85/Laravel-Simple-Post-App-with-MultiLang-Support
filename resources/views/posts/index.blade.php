@extends('layout.app')
@push('css')
    <style>
        button.like_btn {
            background: none;
            border: none;
            font-weight: 500;
            color: #0062cc;
            padding-left: 0;
            padding-right: 10px;
            font-size: 15px;
        }
    </style>
@endpush
@section('title', 'Post Create')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 bg-light mt-3 br-5 rounded p-4">
                Post Create
            </div>
        </div>
    </div>
@endsection
