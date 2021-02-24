@extends('layouts.home')

@section('title', 'Home')

@section('content')
    <div id="appTwo">
        <homepage :categories="{{$restaurant_categories}}"/>
    </div>
@endsection()
