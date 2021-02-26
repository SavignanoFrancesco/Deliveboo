@extends('layouts.home')

@section('title', $restaurant->name)

@section('content')
  {{-- {{dd($dishes)}} --}}
  {{-- {{dd($restaurant->user_id)}} --}}
  @foreach ($dishes_category as $value)
    {{$value->id}}
    {{$value->name}}
  @endforeach
  {{-- {{dd($dishes_category[0]->name)}} --}}
    {{-- Descrizione -- Savignano (da completare per il 16/02) --}}
    {{-- Completare  Menu Restaurant Pubblica sia HTML che CSS che CARRELLO HTML/CSS/JS --}}

    {{-- Restaurant Details --}}
  {{-- <div class="restaurant-page" id="app">

    <section class="restaurant-info">
        <div class="container-fluid">
            <div class="row">
                <div class="restaurant-cover w-full border">
                    <img class="object-cover object-center w-full h-full" src=" {{$restaurant->cover}} " alt=" {{$restaurant->name}} ">
                </div>

                <div class="restaurant-details col-lg-6">
                    <p>Restaurant Details</p>
                    <h1> {{ $restaurant->name }} </h1>

                    <ul class="list-unstyled">
                        <li>Address: <span>{{ $restaurant->address }} </span> </li>
                        <li>Phone Number: <span>{{ $restaurant->phone }}</span></li>
                        <li>E-mail: <span>{{ $restaurant->email }} </span></li>
                    </ul>

                    <div class="restaurant-location">
                        {{-- Inserire qui una google maps del ristorante --}}
                    {{-- </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Restaurant Menus --}}
    {{-- <section class="restaurant-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <h2>Restaurant Menus</h2>
                    <ul>
                        @foreach ($dishes as $dish)
                            @foreach ($dish->menus as $menu)
                                <li class="list-unstyled"> {{ $menu->name }} </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

  {{-- Restaurant Dishes --}}
    {{-- <section class="dishes-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <h2>Have a look our dishes</h2>
                </div>
            </div>

            <div class="row">
                <ul class="d-flex flex-wrap">
                    @foreach ($restaurant->dishes as $dish)
                        @if($dish->visibility)
                            <li class="dish-card">
                                <div class="dish-cover">
                                    <img class="" src=" {{ $dish->cover }} " alt=" {{ $dish->name}} }} ">
                                </div>

                                <div class="dish-dectails">
                                    <h2 class="text-uppercase"> {{ $dish->name }} </h2>
                                    <p>Ingredients:
                                        <span> {{ $dish->ingredients }} </span>
                                    </p>
                                    <p>Description:
                                        <span> {{ $dish->description }} </span>
                                    </p>
                                    <p>Price:
                                        <span> {{ $dish->price }} $</span>
                                    </p>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section> --}}
    {{-- <shopping-cart></shopping-cart>
  </div> --}}
  <div id="cart_comp">

    <section class="restaurant">
        <div class="container">
            <div class="row">

              <div class="restaurant-details-container">
                <div class="restaurant-details">
                    {{-- <p>Restaurant Details</p> --}}
                    <h1> {{ $restaurant->name }} </h1>

                    <ul class="list-unstyled">
                        <li>Address: <span> {{ $restaurant->address }} </span> </li>
                        <li>Phone Number: <span> {{ $restaurant->phone }} </span></li>
                        <li>E-mail: <span> {{ $restaurant->email }} </span></li>
                    </ul>

                    <div class="restaurant-location">
                        {{-- Inserire qui una google maps del ristorante --}}
                    </div>
                </div>

                <div class="restaurant-cover">
                  <img class="" src=" {{asset('storage').'/'.$restaurant->cover}} " alt=" {{$restaurant->name}} ">
                </div>
              </div>
            </div>
            {{-- {{dd($restaurant->categories)}} --}}
            {{-- aggiungo quantità --}}
            @php
            $json_variable = $restaurant->dishes->toJson();
            // dd($json_variable);
            $json_array  = json_decode($json_variable, true);
            $elementCount  = count($json_array);
            for ($i = 0; $i < $elementCount; $i++) {
              $json_array[$i]['quantity'] = 0;
            }
            $json_variable = json_encode($json_array);
            // dd($json_array);
            @endphp

            {{-- {{ dd($restaurant->id) }} --}}
            {{-- VUE COMPONENT --}}
            {{-- {{dd($json_array)}} --}}
            <shopping-cart :flag_restaurant="{{ $restaurant->id }}" :dishes="{{ $json_variable }}"></shopping-cart>

        </div>
    </section>
  </div>
  {{-- <script defer src="{{ asset('js/app.js') }}"></script> --}}
@endsection()
