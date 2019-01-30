@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset("css/SASS/calendar.css")}}">
@endsection

@section('content')
    <div id="calendar"></div>
@endsection

@section('scripts')
    <script src="{{asset('js/mister/calendar.js')}}"></script>
@endsection