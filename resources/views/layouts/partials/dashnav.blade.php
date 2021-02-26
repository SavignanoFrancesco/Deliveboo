<div id="dasboard-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-top">
                        <div class="title">
                            <h1>Ciao {{Auth::user()->company_name}}</h1>
                            <p>questa è la tua dashborad, qui puoi trovare i tuoi contenuti</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dasboard-panel-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-box">
                        <div class="box-contain">
                            <div class="box-img mb-2">
                                <i class="fas fa-home fa-2x"></i>
                            </div>
                            <div class="box-title">
                              {{-- WORKAROUND HREF --}}
                              {{-- @php
                                $href = 'http://localhost:8000/restaurant/'.$restaurant[0]->slug;
                              @endphp--}}
                              <h3><a href="{{route('home')}}">Vai al tuo ristorante</a></h3>  

                              {{-- <h3><a href="{{ route('restaurant',['slug' => $restaurant[0]->slug]) }}">Vai al tuo ristorante</a></h3>
                              {{dd($restaurant[0]->slug)}}--}}
                            </div>
                            <div class="box-content">
                                <p>descrizione</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="main-box">
                        <div class="box-contain">
                            <div class="box-img mb-2">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <div class="box-title">
                                <h3><a href="{{ route('admin.user.index')}}">User</a></h3>
                            </div>
                            <div class="box-content">
                                <p>descrizione</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="main-box">
                        <div class="box-contain">
                            <div class="box-img mb-2">
                                <i class="fas fa-utensils fa-2x"></i>
                            </div>
                            <div class="box-title">
                                <h3><a href="{{route('admin.restaurant.index')}}">Ristoranti</a></h3>
                            </div>
                            <div class="box-content">
                                <p>descrizione</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="main-box">
                        <div class="box-contain">
                            <div class="box-img mb-2">
                                <i class="fas fa-pizza-slice fa-2x"></i>
                            </div>
                            <div class="box-title">
                                <h3><a href="{{route('admin.dish.index')}}">Dishes</a></h3>
                            </div>
                            <div class="box-content">
                                <p>descrizione</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
