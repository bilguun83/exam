<div class="container">
<nav class="navbar navbar-expand-md navbar-dark bg-primary ">
    {{-- navbar navbar-expand-lg navbar-light bg-light" --}}
        <a class="navbar-brand" href="#">{{config('app.name','BBB')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            {{-- <li >
              <a class="nav-link" href="/demo">Шалгалтын түүх<span class="sr-only">(current)</span></a>
            </li> --}}

            <!-- include('teacher-menu') -->

            @if (Auth::user()->group_id==2)

              {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Шалгалтууд</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/admin/test">Бүгд</a>
                    <a class="dropdown-item" href="#">Холбоо</a>
                    <a class="dropdown-item" href="#">Навигаци</a>
                    <a class="dropdown-item" href="#">Ажиглалт</a>
                    <a class="dropdown-item" href="#">Цахилгаан</a>
                    <a class="dropdown-item" href="#">Бусад</a>
                  </div>
                </li> --}}
              <li >
                  <a class="nav-link" href="/student/request">Шалгалтын хүсэлт<span class="sr-only">(current)</span></a>
              </li>
              <li >
                  <a class="nav-link" href="/student/history">Шалгалтын түүх<span class="sr-only">(current)</span></a>
              </li>
                <li >
                  <a class="nav-link" href="/admin/test">Тестийн сан<span class="sr-only">(current)</span></a>
              </li>
              <li >
                  <a class="nav-link" href="/admin/student">Хэрэглэгчид<span class="sr-only">(current)</span></a>
              </li>
              <li >
                <a class="nav-link" href="/admin/section">Хэсэгүүд<span class="sr-only">(current)</span></a>
            </li> 
            @endif
{{-- 
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li> --}}
            

          </ul>
          <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->fname }} {{ Auth::user()->lname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit" >Хувийн мэдээлэл засах</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>  
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
      </nav>
</div>