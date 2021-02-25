{{-- Descrizione -- Bello (da completare per il 16/02 sia HTML che CSS che JS) --}}
{{-- Da completare la sidebar verticale Publica sia chiusa che aperta con interazione la JS --}}


    <div class="sidebar-top">
      <div class="sidebar-link">
        <ul>
          <li><a href="{{ route('home') }}"><i class="fas fa-home"></i><p class="text">Homepage</p> </a> </li>
          <li><a href="{{ route('contacts') }}"><i class="far fa-envelope"></i><p class="text">Contact Us</p> </a> </li>

  @if (Route::has('login'))

          @auth
            <li><a href="{{ route('login') }}"><i class="fas fa-qrcode"></i><p class="text">Dashboard</p> </a> </li>
            <li>
              {{-- aggiunto logout frontoffice --}}
              <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i><p class="text">LogOut</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>

             </li>






          @else
            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i><p class="text">LogIn</p> </a> </li>

              @if (Route::has('register'))
                <li><a href="{{ route('register') }}">Register </a> </li>
              @endif

          @endauth

            </ul>



{{-- </div> --}}

@endif


    </div>
      </div>
