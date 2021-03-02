<div id="dasboard-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-top">
                        <div class="title">
                            <h1>Ciao {{Auth::user()->company_name}},</h1>
                            <p>Questa è la tua dashboard, qui puoi trovare i tuoi contenuti</p>
                            <a href="{{route('admin.home')}}" class="btn btn-light mt-3">Back-Office</a>
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
                              @if ($restaurant)
                                {{-- {{dd($restaurant)}} --}}
                                <h3><a href="{{ route('restaurant',['slug' => $restaurant->slug]) }}">Vai al tuo ristorante</a></h3>
                              @else
                                <h3><a href="{{route('home')}}">Visita il sito</a></h3>
                              @endif
                            </div>
                            <div class="box-content">
                                <p>Descrizione</p>
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
                                <h3><a href="{{ route('admin.user.index')}}">Utente</a></h3>
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
                              @if ($restaurant)
                                <h3><a href="{{route('admin.restaurant.index')}}">Ristoranti</a></h3>
                              @else
                                <h3><a href="{{route('admin.restaurant.create')}}">Ristoranti</a></h3>
                              @endif
                            </div>
                            <div class="box-content">
                                <p>descrizione</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{dd($restaurant)}} --}}
                @if ($restaurant)
                  <div class="col-lg-3">
                      <div class="main-box">
                          <div class="box-contain">
                              <div class="box-img mb-2">
                                  <i class="fas fa-pizza-slice fa-2x"></i>
                              </div>
                              <div class="box-title">
                                  <h3><a href="{{route('admin.dish.index')}}">Piatti</a></h3>
                              </div>
                              <div class="box-content">
                                  <p>descrizione</p>
                              </div>
                          </div>
                      </div>
                  </div>
                @endif
            </div>
        </div>
    </div>
