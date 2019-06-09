@extends('layout')
@section('title')
    پنل کاربر
@stop


@section('content')
    <section class=" container-fluid  mt-4 mx-2" id="app">

        {{--@if(auth()->user())--}}
        <search-box schools-link="{{route('school.search')}}"
                    hoozes-link="{{route('school.hoozes')}}"></search-box>

        <pagination></pagination>
        <school-cards user="{{auth()->user()}}"></school-cards>

        <div class="row  justify-content-center">
            <div class="no-result text-center py-4 text-danger  hide">نتیــجه ای یافت نشد</div>
            <div class="loading-page center-block  "></div>
        </div>
        {{--@else--}}

        {{--<div class="no-result text-center py-4 text-danger">--}}
        {{--<p>--}}
        {{--<strong>--}}
        {{--لطفا ابتدا--}}
        {{--<a href="{{route('login')}}">وارد</a>--}}
        {{--شوید یا--}}
        {{--<a href="{{route('register')}}">ثبت نام</a>--}}
        {{--کنید--}}
        {{--</strong>--}}
        {{--</p>--}}
        {{--</div>--}}
        {{--@endif--}}
    </section>


@stop
@section('scripts')

    {{--<script>  let map = new ol.Map({--}}
    {{--target: 'map',--}}
    {{--layers: [--}}
    {{--new ol.layer.Tile({--}}
    {{--source: new ol.source.OSM()--}}
    {{--})--}}
    {{--],--}}
    {{--view: new ol.View({--}}
    {{--center: ol.proj.fromLonLat([37.41, 8.82]),--}}
    {{--zoom: 4--}}
    {{--})--}}
    {{--});</script>--}}
@stop