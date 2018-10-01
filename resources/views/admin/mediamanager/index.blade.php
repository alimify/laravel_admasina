@extends('layouts.admin.app')

@section('title','Media Manager')

@push('css')
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
@endpush


@section('content')
    <div id="app">
        <media-manager></media-manager>
    </div>
@endsection


@push('script')
    <script src="{{asset('assets/admin/js/app.js')}}"></script>
@endpush
