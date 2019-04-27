@extends('layout')

@section('title')
    مدارس
@stop

@section('content')

    <school-cards schools-link="{{route('madrese.all')}}"></school-cards>

@stop