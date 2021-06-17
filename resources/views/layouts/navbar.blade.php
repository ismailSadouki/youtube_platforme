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
