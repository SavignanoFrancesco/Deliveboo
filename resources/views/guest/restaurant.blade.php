@extends('layouts.home')

@section('title', $restaurant->name)

@section('content')
  {{-- {{dd($dishes)}} --}}
  {{-- {{dd($restaurant->user_id)}} --}}
  {{-- {{dd($dishes_category)}} --}}
  @php
    $array_dishes_categories = $dishes_category->toArray();
    for ($i=0; $i < count($array_dishes_categories); $i++) {
      unset($array_dishes_categories[$i]['description']);
      unset($array_dishes_categories[$i]['slug']);
      unset($array_dishes_categories[$i]['created_at']);
      unset($array_dishes_categories[$i]['updated_at']);
    }
    $json_dishes_categories = json_encode($array_dishes_categories);
    // dd($json_dishes_categories);
  @endphp

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
            <shopping-cart :flag_restaurant="{{ $restaurant->id }}" :dishes="{{ $json_variable }}" :dishes_categories="{{ $json_dishes_categories }}"></shopping-cart>

        </div>
    </section>
  </div>
  {{-- <script defer src="{{ asset('js/app.js') }}"></script> --}}
@endsection()
