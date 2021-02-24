@extends('layouts.app')

@section('content')


    <section id="card-single-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-auto">
                        <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">

                            <div class="flex justify-center -mt-8">
                                <img src="{{asset('storage/' . $dishes->cover)}}"
                                     class="rounded-full border-solid border-white border-2 -mt-3" width="100px">
                            </div>
                            <div class="text-center px-3 pb-6 pt-2">
                                <h3 class="text-black text-sm bold font-sans">Nome prodotto:{{$dishes->name}}</h3>
                                <p class="mt-2 font-sans font-light text-grey-dark">Prezzo: {{$dishes->price}} €</p>
                                <p class="mt-2 font-sans font-light text-grey-dark">Ingredienti: {{$dishes->ingredients}}</p>
                                <!-- <p class="mt-2 font-sans font-light text-grey-dark">Categorie: </p> -->
                            </div>
                            <div class="box-desc">
                                <p>Descrizione:</p>
                                <p>{{$dishes->description}}</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection

