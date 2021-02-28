@extends('layouts.home')

@section('title', $restaurant->name)

@section('content')

  {{-- {{dd($restaurant)}} --}}

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

            {{--INIZIO SPAGHETTI PHP --}}
            @php

              // strutturazione array associativo id_categoria => nome_categoria}
              $array_dishes_categories = $dishes_category->toArray();
              for ($i=0; $i < count($array_dishes_categories); $i++) {
                unset($array_dishes_categories[$i]['description']);
                unset($array_dishes_categories[$i]['slug']);
                unset($array_dishes_categories[$i]['created_at']);
                unset($array_dishes_categories[$i]['updated_at']);
              }
              // dd($array_dishes_categorie);

              // rimuovo attributi non utili al componente, aggiungo attributo quantità e sostituisco id categoria con nome categoria
              $dishes_array  = $restaurant->dishes->toArray();
              for ($i = 0; $i < count($dishes_array); $i++) {

                unset($dishes_array[$i]['restaurant_id']);
                unset($dishes_array[$i]['created_at']);
                unset($dishes_array[$i]['updated_at']);
                $dishes_array[$i]['quantity'] = 0;

                for ($j = 0; $j < count($array_dishes_categories); $j++) {

                  // aggiungo nome categoria piatto
                  if ($dishes_array[$i]['dish_category_id'] == $array_dishes_categories[$j]['id']) {
                    $dishes_array[$i]['dish_category_name'] = $array_dishes_categories[$j]['name'];
                  }

                }

              }

              // traduco da array a json per il componente
              // $json_dishes_categories = json_encode($array_dishes_categories);
              $json_dishes_with_category_names = json_encode($dishes_array);

            @endphp
            {{--FINE SPAGHETTI PHP --}}

            {{-- VUE COMPONENT --}}
            <shopping-cart :flag_restaurant="{{ $restaurant->id }}" :dishes="{{ $json_dishes_with_category_names }}"></shopping-cart>

        </div>
    </section>
  </div>

@endsection()
