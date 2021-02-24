@extends('layouts.app')

@section('content')

    <section id="create-dish">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-create">
                        <div>
                            <a href="{{ route('admin.restaurant.create') }}">
                                Crea ristorante
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-restaurant-cards-container" class="p-5">
        <div class="container-fluid">
            <div class="row">
                @foreach($restaurants as $restaurant)
                    <div class="col-lg-4 mx-auto">
                        <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">

                            <div class="flex justify-center -mt-8">
                                <img src="{{ asset('storage/' . $restaurant->cover) }}"
                                     class="rounded-full border-solid border-white border-2 -mt-3" width="100px">
                            </div>
                            <div class="text-center px-3 pb-6 pt-2">
                                <h3 class="text-black text-sm bold font-sans">Name: {{ $restaurant->name }}</h3>
                                <p class="mt-2 font-sans font-light text-grey-dark">Address: {{$restaurant->address}} </p>
                                <p class="mt-2 font-sans font-light text-grey-dark">Phone: {{$restaurant->phone}}</p>
                                <p class="mt-2 font-sans font-light text-grey-dark">Email: {{$restaurant->email}}</p>
                            </div>
                            <div class="flex justify-center pb-3 text-grey-dark">
                                <div class="text-center mr-3 border-r pr-3">
                                    <a href="{{ route('admin.restaurant.edit', ['restaurant' => $restaurant->slug]) }}"
                                       class="btn btn-success">Edit</a>
                                </div>
                                {{-- -- --}}

                                {{-- card-bottom-left crud controls --}}
                                <div id="dash-restaurant-crud-controls">
                                    <div>
                                        <a href="{{ route('admin.restaurant.edit', ['restaurant' => $restaurant->slug]) }}">
                                            <span class="far fa-edit"></span>
                                            Edit
                                        </a>
                                    </div>
                                    <div>
                                        <form method="POST"
                                              action="{{ route('admin.restaurant.destroy', ['restaurant' => $restaurant->slug]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="mx-3">
                                                <span class="fas fa-eraser"></span>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.restaurant.show', ['restaurant' => $restaurant->slug]) }}">
                                            <span class="far fa-eye"></span>
                                            View
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center mr-3 border-r pr-3">
                                    <a href="{{ route('admin.restaurant.show', ['restaurant' => $restaurant->slug]) }}"
                                       class="btn btn-primary">View</a>
                                </div>

                                <div class="text-center mr-3 border-r pr-3 mt-2">
                                    <a href="{{ route('admin.dish.index') }}"
                                       class="btn btn-secondary">Tuoi piatti</a>
                                </div>
                            </div>
                            {{-- -- --}}

                            {{-- card-right --}}
                            <div id="dash-restaurant-card-right">
                                <a href="{{ route('admin.menu.index', ['restaurant' => $restaurant->slug])}}">
                                    <span class="fas fa-utensils"></span>
                                    Menus
                                </a>

                                <a href="{{ route('admin.dish.index') }}">
                                    <span class="fas fa-hamburger"></span>
                                    Dishes
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
