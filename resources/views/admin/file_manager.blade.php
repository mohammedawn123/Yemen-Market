@extends('layouts.admin.index')
@section('content')

@endsection

@push('styles')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush
@push('home_scripts')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>



@endpush
