@extends('layouts.app')

@section('content')

    @extends('layouts.partials.search')

    <h1>Dashboard</h1>
    <h2>{{Auth::user()->company_name}}</h2>
    <h3>Summary</h3>

    <a class="dropdown-item" href="{{ route('admin.user.index')}}">User info</a>

    <a class="dropdown-item" href="{{ route('admin.restaurant.index') }}">Restaurants</a>

    {{-- <a class="dropdown-item" href="{{ route('admin.menu.index', ['restaurant' => $restaurant])}}">Menus</a> --}}

    <a class="dropdown-item" href="{{ route('admin.dish.index') }}">Dishes</a>

    <a class="dropdown-item" href="{{ route('admin.stats.index') }}">Stats</a>
@endsection
