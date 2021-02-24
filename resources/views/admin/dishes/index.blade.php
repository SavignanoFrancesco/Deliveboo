@extends('layouts.app')

@section('content')

    @if($restaurant->isEmpty())
    <h1>Devi creare prima un ristorante</h1>
    @else
        <section id="create-dish">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-create">
                        <div class="text-center mr-3 border-r pr-3">
                            <a href="{{route('admin.dish.create')}}" class="btn btn-primary">Crea piatto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section id="card">
        <div class="container">
            <div class="row">
                @foreach($dishes as $dish)
                    <div class="col-lg-4 mx-auto">
                        <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">

                            <div class="flex justify-center -mt-8">
                                <img src="{{asset('storage/' . $dish->cover)}}"
                                     class="rounded-full border-solid border-white border-2 -mt-3" width="100px">
                            </div>
                            <div class="text-center px-3 pb-6 pt-2">
                                <h3 class="text-black text-sm bold font-sans">Nome prodotto:{{$dish->name}}</h3>
                                <p class="mt-2 font-sans font-light text-grey-dark">Prezzo: {{$dish->price}} €</p>
                                <p class="mt-2 font-sans font-light text-grey-dark">Ingedienti</p>
                            </div>
                            <div class="flex justify-center pb-3 text-grey-dark">
                                <div class="text-center mr-3 border-r pr-3">
                                    <a href="{{route('admin.dish.edit', ['dish' => $dish->slug])}}"
                                       class="btn btn-success">Edit</a>
                                </div>
                                <div class="text-center mr-3 border-r pr-3">
                                    <form method="POST" class="d-inline-block"
                                          action="{{route('admin.dish.destroy', ['dish' => $dish->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                <div class="text-center mr-3 border-r pr-3">
                                    <a href="{{route('admin.dish.show', ['dish' => $dish->slug])}}"
                                       class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
