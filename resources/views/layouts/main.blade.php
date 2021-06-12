<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>يوتيوبي</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    @yield('style')

</head>
<body class="mt-5 rtl ">
    <div class="layer"></div>

     <div id="top-menu">
        <div class="container-fluid">
           <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
               <i class="fas fa-bars fa-2x" id="toggler"></i>
                <b>
                    <a class="navbar-brand" href="index.html">
                        يوتيوبي<span class="video-icon"><i class="fa fa-play-circle p-1"></i></span>
                    </a>
                </b>
 
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-lg-auto px-md-0 px-lg-auto">
                    <li class="nav-item ">
                        <a class="nav-link mr-2 px-3 ml-1" href="{{ route('videos.create') }}"><i class="fas fa-file-video" title="رفع فيديو جديد"></i></a>
                    </li>
                  <li class="nav-item first-list-element">
                    <a class="nav-link mr-2 px-3 ml-1" href="#">الفيديوهات المقترحة</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link ml-lg-3 px-3 ml-1" href="#">المرفوعة حديثا</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-3 ml-1" href="#" >ألفيديوهات الرائجة</a>
                  </li>
                </ul>

                <div class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="ابحث عن ..." a>
                  <button class="btn btn-outline-info my-2 my-sm-0 " type="submit" onclick="location.href='search.html';">ابحث</button>
                </div>
                 <i class="fas fa-search mr-4 search-icon"></i>

                @guest
                    <a class="nav-link login" href="#"  data-toggle="modal" data-target="#loginModal">تسجيل الدخول</a>
                @else 
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown justify-content-left ">
                            <a href="#" id="navbarDropdown" class="nav-link" data-toggle="dropdown" style="background-color: #fff">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-left px-4 text-left mt-2" style="left: 0;
                            right: inherit;">
                                <div class="pt-4 pb-1 border-t border-gray-200">
                                    <div class="flex items-center px-4">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <div class="flex-shrink-0 ml-3">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </div>
                                        @endif
                        
                                        <div class="ml-3">
                                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                        
                                    <div class="mt-3 space-y-1">
                                        <!-- Account Management -->
                                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                            {{ __('site.profile') }}
                                        </x-jet-responsive-nav-link>
                        
                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                                {{ __('site.api_token') }}
                                            </x-jet-responsive-nav-link>
                                        @endif
                        
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                        
                                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('site.logout') }}
                                            </x-jet-responsive-nav-link>
                                        </form>
                        
                                        <!-- Team Management -->
                                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                            <div class="border-t border-gray-200"></div>
                        
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('site.manage_team') }}
                                            </div>
                        
                                            <!-- Team Settings -->
                                            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                                {{ __('site.team_settings') }}
                                            </x-jet-responsive-nav-link>
                        
                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                    {{ __('site.new_team') }}
                                                </x-jet-responsive-nav-link>
                                            @endcan
                        
                                            <div class="border-t border-gray-200"></div>
                        
                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('site.team_switch') }}
                                            </div>
                        
                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>

                        
                    </ul>
                @endguest

              </div>
             

           </nav>
           <input type="search" class="form-control search-input " placeholder="ابحث عن ...">

    
           <!-- Modal -->
           <div class="modal fade" id="loginModal" tabindex="-1" >
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">تسجيل الدخول</h5>
                          <button type="button" class="close" data-dismiss="modal">
                              <span>&times;</span>
                          </button>
                      </div>
                       <form method="POST" action="{{ route('login') }}">
                         @csrf
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">البريد الاكتروني:</label>
                                        <input type="email" class="form-control" id="email" type="email" name="email" :value="old('email')"  autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">كلمة السر:</label>
                                        <input type="password" class="form-control" id="password" type="password" name="password"  autocomplete="current-password">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('password.request') }}">نسيت كلمة المرور</a>
                                <a href="{{ route('register') }}" class="mx-auto">انشاء حساب</a>
                                <button type="submit" class="btn btn-primary">دخول</button>
                            </div>
                        </form>

                  </div>
              </div>
           </div>


           <!-- sidebar -->
           <div class="row pt-4">
               <div id="wrap">
                   <div class="sidebar">
                      <ul class="list-group list-group-flush pl-0">
                        <a href="index.html" class="list-group-item list-group-item-action">
                            <i class="fas fa-home mr-2 purple"></i> الصفحة الرئيسية
                        </a>
                        <a href="index.html" class="list-group-item list-group-item-action">
                            <i class="fab fa-algolia mr-2 purple"></i> الفيديوهات المقترحة
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="far fa-plus-square mr-2 purple"></i> المرفوعة حديثًا
                         </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-fire-alt mr-2 purple"></i> الفيديوهات الرائجة
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-fire-alt mr-2 purple"></i> فيديوهاتي
                        </a>
                        <a href="log.html" class="list-group-item list-group-item-action">
                            <i class="fas fa-history mr-2 purple"></i> سجل المشاهدة
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="far fa-share-square mr-2 purple"></i> الإشتراكات
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-film mr-2 purple"></i> الأفلام والعروض
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-gamepad mr-2 purple"></i> ألعاب فيديو
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-tshirt mr-2 purple"></i> الموضة والجمال
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-graduation-cap mr-2 purple"></i> محتوى تعليمي
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-cog mr-2 purple"></i> الإعدادات
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-question-circle mr-2 purple"></i> مساعدة
                        </a>
                        <a href="https://mostaql.com/u/ismail_sadouki" class="list-group-item list-group-item-action last-a">
                          اسماعيل صدوقي
                        &copy; 2021  
                        </a>
                      </ul>
                   </div>
               </div>
           </div> <!-- End Sidebar -->
          
           <!-- -->
            <div class="content m-4">
                @if (Session::has('success'))
                    <div class="p-3 mb-2 bg-success text-white rounded mx-auto col-8">
                        <span class="text-center">{{ session('success') }}</span>
                    </div>
                @endif
                @yield('title')
              <div class="row">
                  {{-- <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card p-1 mb-4">
                        <a href="watch.html">
                            <div class="card-icons">
                                <img class="card-img-top" src="img/thumbnail/restful.jpg" alt="Card image cap">
                                <time>9:14</time>
                                <i class="fa fa-play fa-2x"></i>
                            </div>
                        </a>
                        <a href="watch.html">
                            <div class="card-body p-0">
                                <p class="card-title">شرح فلسفة RESTful - تعلم كيف تبني واجهات REST برمجية</p>
                            </div>
                        </a>
                        <div class="card-footer">
                            <small class="text-muted">
                                <span class="d-block">
                                    <i class="fas fa-film"></i> <span>3 آلاف مشاهدة</span>
                                </span>
                                <i class="fas fa-clock"></i> <span>قبل 5 أشهر</span>
                            </small>
                        </div>
                        <a href="channel.html" class="channel-img">
                            <img src="img/ch-logo.png" alt="" class="rounded-circle my-2 ml-3" width="30">
                            <span class="card-text">أكاديمية حسوب</span>
                        </a>
                    </div>
                   </div> --}}
          
             
             
             
             
             
             
             
             
                    @yield('content')
             
             
                </div>
            </div>

        </div>
    </div>




    <script src="https://kit.fontawesome.com/dc9e78ad18.js" crossorigin="anonymous"></script>
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
    @yield('script')
</body>
</html>