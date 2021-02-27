@extends('layouts.app')

@section('content')

    @include('layouts.partials.dashnav')

    @if($restaurants->isEmpty())
    <section id="create-dish">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-create mb-5">
                        <div class="text-center mr-3 border-r pr-3">
                            <a href="{{route('admin.restaurant.create')}}" class="btn btn-primary">Crea ristorante</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section id="dash-restaurant-cards-container" class="p-5">
        <div class="container">
            <div class="row">
                @foreach($restaurants as $restaurant)
                    <div class="col-lg-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('storage/' . $restaurant->cover)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title text-capitalize">{{$restaurant->name}}</h3>
                                <p class="card-text mb-3">{{$restaurant->description}}</p>
                                <a href="{{ route('admin.restaurant.edit', ['restaurant' => $restaurant->slug]) }}"
                                   class="btn btn-primary">Edit</a>
                                <a href="{{ route('admin.restaurant.show', ['restaurant' => $restaurant->slug]) }}"
                                   class="btn btn-warning">Show</a>
                                <form method="POST" class="d-inline-block"
                                      action="{{ route('admin.restaurant.destroy', ['restaurant' => $restaurant->slug]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
