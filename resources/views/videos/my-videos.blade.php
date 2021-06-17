@extends('layouts.main')
@section('title')
    <h4 class="py-5">{{ $title }}</h4>   
@endsection
@section('content')
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

    @forelse ($videos as $video)
        @if ($video->processed)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card p-1 mb-4">
                    <a href="watch.html">
                        <div class="card-icons">
                            @php
                                $hours_add_zero = sprintf("%02d", $video->hours);
                            @endphp
                            @php
                                $minutes_add_zero = sprintf("%02d", $video->minutes);
                            @endphp
                            @php
                                $seconds_add_zero = sprintf("%02d", $video->seconds);
                            @endphp
                            <img class="card-img-top" src="{{ asset('storage/'.$video->image_path) }}" alt="{{ Str::limit($video->title, 20) }}">
                            <time>{{ ($video->hours) > 0 ? $hours_add_zero .':' : ''}}{{$minutes_add_zero}}:{{$seconds_add_zero}}</time>
                            <i class="fa fa-play fa-2x"></i>
                        </div>
                    </a>
                    <a href="watch.html">
                        <div class="card-body p-0">
                            <p class="card-title">{{ Str::limit($video->title, 60) }}</p>
                        </div>
                    </a>
                    <div class="card-footer">
                        <small class="text-muted">
                            <span class="d-block">
                                <i class="fas fa-film"></i> <span>3 آلاف مشاهدة</span>
                            </span>
                            <i class="fas fa-clock"></i> <span>قبل 5 أشهر</span>

                            @auth
                                @if($video->user_id == auth()->user()->id || auth()->user()->administration_level > 0)
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('هل انت متأكد من انك تريد حذف الفيديو هذا؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="float-left"><i class="far fa-trash-alt text-danger fa-lg"></i></button>
                                    </form>
                                @endif
                            @endauth
                        </small>
                    </div>
                    <a href="channel.html" class="channel-img">
                        <img src="img/ch-logo.png" style="display: inline" alt="" class="rounded-circle my-2 ml-3" width="30">
                        <span class="card-text">أكاديمية حسوب</span>
                    </a>
                </div>
            </div>
        @endif
    @empty
        <div class="mx-auto col-8">
            <div class="alert alert-primary text-center">
                لا يوجد فيديوهات
            </div>
        </div>
    @endforelse
             
@endsection
