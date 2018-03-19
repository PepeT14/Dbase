@extends('layouts.app')
@section('content')
    {!!  $calendar->calendar() !!}

@endsection
@section('scripts')
    {!!  $calendar->script() !!}

@endsection
