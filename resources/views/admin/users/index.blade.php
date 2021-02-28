@extends('layouts.app')

@section('content')

    {{-- @include('layouts.partials.dashnav') --}}

    <section id="user-card mt-5">
        <div class="container">
            <div class="row">

                    <div class="col-lg-4 mb-5">
                    <div class="card-container">
                        <div class="card" style="width: 18rem;">
                            @if($users->cover)
                                <img class="card-img-top" src="..." alt="Card image cap">
                            @else
                                <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSppkoKsaYMuIoNLDH7O8ePOacLPG1mKXtEng&usqp=CAU" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">Name: {{$users->owner_name}}</h5>
                                <p class="card-text">Email: {{$users->email}}</p>
                                <a href="{{route('admin.user.show', ['user' => $users->id])}}" class="btn btn-primary">Visualizza</a>
                                <a href="{{route('admin.user.edit', ['user' => $users->id])}}" class="btn btn-success">Modifica</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
