@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/videos/watch.css') }}">
@endsection

@section('content')
    
<div class="watch-page pt-5">
    <div class="container-fluid">
        <div class="card border-0">
            <div class="row px-2">
                <div class="col-md-7">
                    @foreach ($video->convertedvideos as $video_converted)
                    <video  id="videoPlayer" controls style="{{ $video->Longitudinal == "0" ? "width: 85%;height:90%;" : "width: 900px; height: 510px"}}">
                             @if($video->quality == 1080)
                                <source id="webm_source" src="{{ asset('storage/'.$video_converted->webm_Format_1080) }}" type="video/webm">
                                <source id="mp4_source" src="{{ asset('storage/'.$video_converted->mp4_Format_1080)  }}" type="video/mp4">
                             @elseif($video->quality == 720) 
                                <source id="webm_source" src="{{ asset('storage/'.$video_converted->webm_Format_720) }}" type="video/webm">
                                <source id="mp4_source" src="{{ asset('storage/'.$video_converted->mp4_Format_720)  }}" type="video/mp4">
                            @elseif($video->quality == 420) 
                                <source id="webm_source" src="{{ asset('storage/'.$video_converted->webm_Format_480) }}" type="video/webm">
                                <source id="mp4_source" src="{{ asset('storage/'.$video_converted->mp4_Format_480)  }}" type="video/mp4">
                            @elseif($video->quality == 360) 
                                <source id="webm_source" src="{{ asset('storage/'.$video_converted->webm_Format_360) }}" type="video/webm">
                                <source id="mp4_source" src="{{ asset('storage/'.$video_converted->mp4_Format_360)  }}" type="video/mp4">
                            @else
                                <source id="webm_source" src="{{ asset('storage/'.$video_converted->webm_Format_240) }}" type="video/webm">
                                <source id="mp4_source" src="{{ asset('storage/'.$video_converted->mp4_Format_240)  }}" type="video/mp4">
                            @endif
                        </video>
                    @endforeach        
                    <select id='qualityPick'>
                        <option value="1080" {{ $video->quality == 1080 ? 'selected' : ''}} {{ $video->quality < 1080 ? 'hidden' : ''}}>1080p</option>
                        <option value="720" {{ $video->quality == 720 ? 'selected' : ''}} {{ $video->quality < 720 ? 'hidden' : ''}}>720p</option>
                        <option value="480" {{ $video->quality == 480 ? 'selected' : ''}} {{ $video->quality < 480 ? 'hidden' : ''}}>480p</option>
                        <option value="360" {{ $video->quality == 360 ? 'selected' : ''}} {{ $video->quality < 360 ? 'hidden' : ''}}>360p</option>
                        <option value="240" {{ $video->quality == 240 ? 'selected' : ''}}>240p</option> 
                    </select>    
                </div>
               
                <div class="col-md-5">
                    <div class="card-block">
                        <small class="text-muted">
                            <i class="fas fa-film"></i> <span>200 ألف مشاهدة</span>
                            <i class="fas fa-clock"></i> <span>قبل 4 أشهر</span>
                            <a href="channel.html" class="channel-img">
                                <img src="img/ch-logo.png" alt="" class="rounded-circle my-2 ml-3" width="30">
                                <span class="card-text">أكاديمية حسوب</span>
                            </a>
                        </small>
                        <a href="watch.html"><h4>{{ $video->title }}</h4></a>
                        <p>تم إعداد هذه الدورة على يد نخبة من أفضل المبرمجين العرب بتسلسل بسيط وواضح، بإنهائك لها ستصبح مطوّر واجهات مستخدم <span id="dots">...</span><span id="more"> دون الحاجة
                            لامتلاك معرفة سابقة بالبرمجة، خلال هذه ستتعلم تطوير واجهات المستخدم خطوة بخطوة اعتمادًا على التجربة
                            العملية والمادة العلمية التي يقدمها مدربون محترفون.</span>
                        </p>
                        <button class="btn mb-4" id="myBtn">عرض المزيد</button>
                    </div>
                    <div class="watch-icons">
                        <a href="#" class="like">
                            @if ($userLike)
                                @if ($userLike->like == 1)                                    
                                    <i class="far fa-thumbs-up bg-secondary p-1 rounded-circle mr-1 text-white liked" title="اعجبني"></i>
                                    <span id="likeNumber">{{ $countLike }}</span>
                                @else     
                                    <i class="far fa-thumbs-up bg-secondary p-1 rounded-circle mr-1 text-white" title="اعجبني"></i>
                                    <span id="likeNumber">{{ $countLike }}</span>
                                @endif
                            @else 
                                <i class="far fa-thumbs-up bg-secondary p-1 rounded-circle mr-1 text-white" title="اعجبني"></i>
                                <span id="likeNumber">{{ $countLike }}</span>
                            @endif
                        </a>
                        <a href="#" class="like">
                            @if ($userLike)
                                @if ($userLike->like == 0)
                                    <i class="far fa-thumbs-down bg-secondary p-1 rounded-circle mr-1 text-white liked" title="لم يعجبني"></i>
                                    <span id="dislikeNumber">{{ $countDislike }}</span>
                                @else    
                                    <i class="far fa-thumbs-down bg-secondary p-1 rounded-circle mr-1 text-white" title="لم يعجبني"></i>
                                    <span id="dislikeNumber">{{ $countDislike }}</span>
                                @endif
                            @else
                                <i class="far fa-thumbs-down bg-secondary p-1 rounded-circle mr-1 text-white" title="لم يعجبني"></i>
                                <span id="dislikeNumber">{{ $countDislike }}</span>
                            @endif
                        </a>
                        <i class="far fa-clock bg-secondary p-1 rounded-circle mr-1 text-white" title="المشاهدة لاحقا"></i>
                        <i class="far fa-share-square bg-secondary p-1 rounded-circle mr-1 text-white" title="مشاركة"></i>
                        <i class="far fa-play-circle bg-secondary p-1 rounded-circle mr-1 text-white" title="اضافة الى قائمة التشغيل"></i>
                        <span class="ml-3">ابلاغ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 px-2">
            <!-- comments -->
            <div class="col-lg-7 order-2 order-lg-1">
                <div class="comments">
                    <div class="comments-details mb-3">
                        <span>التعليقات 4</span>
                        <span class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                              الترتيب بحسب
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">التاريخ</a>
                              <a class="dropdown-item" href="#">التعليقات الاحدث</a>
                            </div>
                        </span>
                    </div>
                    <div class="public-comments">
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="اضافة تعليق عام"></textarea>
                            <button type="submit" class="btn btn-info mt-3">تعليق</button>

                            <div class="card mt-5 mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                            <p class="text-secondary text-center reply-time">منذ 20 دقيقة</p>
                                        </div>
                                        <div class="col-10">
                                            <p>
                                                <a class="float-right mt-3 mt-md-4" href="#"><strong>محمد محمد</strong></a>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                        
                                           </p>
                                           <div class="clearfix"></div>
                                            <p>دورة رائعة</p>
                                            <p>
                                                <a class="reply float-right btn text-white btn-info mr-2 mt-4"> <i class="fa fa-reply"></i> الردود</a>
                                                <a class="float-right btn text-white btn-info mt-4"> <i class="fa fa-heart"></i> اعجبني</a>
                                           </p>
                                        </div>
                                    </div>
                                    <div class="card ml-5 mt-3  card-inner">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                                    <p class="text-secondary text-center reply-time">منذ 10 دقائق</p>
                                                </div>
                                                <div class="col-10">
                                                    <p><a href="#"><strong>محمد امين</strong></a></p>
                                                    <p>شكرا.</p>
                                                    <p>
                                                        <a class="float-right btn text-white btn-info"> <i class="fa fa-heart"></i> اعجبني</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5 mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                            <p class="text-secondary text-center reply-time">منذ 20 دقيقة</p>
                                        </div>
                                        <div class="col-10">
                                            <p>
                                                <a class="float-right mt-3 mt-md-4" href="#"><strong>محمد محمد</strong></a>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                        
                                           </p>
                                           <div class="clearfix"></div>
                                            <p>دورة رائعة</p>
                                            <p>
                                                <a class="reply float-right btn text-white btn-info mr-2 mt-4"> <i class="fa fa-reply"></i> الردود</a>
                                                <a class="float-right btn text-white btn-info mt-4"> <i class="fa fa-heart"></i> اعجبني</a>
                                           </p>
                                        </div>
                                    </div>
                                    <div class="card ml-5 mt-3  card-inner">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                                    <p class="text-secondary text-center reply-time">منذ 10 دقائق</p>
                                                </div>
                                                <div class="col-10">
                                                    <p><a href="#"><strong>محمد امين</strong></a></p>
                                                    <p>شكرا.</p>
                                                    <p>
                                                        <a class="float-right btn text-white btn-info"> <i class="fa fa-heart"></i> اعجبني</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5 mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                            <p class="text-secondary text-center reply-time">منذ 20 دقيقة</p>
                                        </div>
                                        <div class="col-10">
                                            <p>
                                                <a class="float-right mt-3 mt-md-4" href="#"><strong>محمد محمد</strong></a>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                                                <span class="float-left"><i class="text-warning fa fa-star"></i></span>
                        
                                           </p>
                                           <div class="clearfix"></div>
                                            <p>دورة رائعة</p>
                                            <p>
                                                <a class="reply float-right btn text-white btn-info mr-2 mt-4"> <i class="fa fa-reply"></i> الردود</a>
                                                <a class="float-right btn text-white btn-info mt-4"> <i class="fa fa-heart"></i> اعجبني</a>
                                           </p>
                                        </div>
                                    </div>
                                    <div class="card ml-5 mt-3  card-inner">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                                    <p class="text-secondary text-center reply-time">منذ 10 دقائق</p>
                                                </div>
                                                <div class="col-10">
                                                    <p><a href="#"><strong>محمد امين</strong></a></p>
                                                    <p>شكرا.</p>
                                                    <p>
                                                        <a class="float-right btn text-white btn-info"> <i class="fa fa-heart"></i> اعجبني</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> <!-- End comments -->

            <div class="col-lg-5 order-1 order-lg-2">
                <p>الاقتراحات</p>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="watch.html">
                                <div class="card-icons">
                                    <img class="w-100 h-100" src="img/thumbnail/ruby.jpg" alt="">
                                    <time>10:13</time>
                                    <i class="fa fa-play fa-2x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>دورة تطوير تطبيقات الويب باستخدام لغة Ruby - أكاديمية حسوب</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>1.6 مليون مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-2">
                                    <img src="img/ch-logo.png" alt="" width="30" class="search-img rounded-circle">
                                    <span class="card-text">أكاديمية حسوب</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="watch.html">
                                <div class="card-icons">
                                    <img class="w-100 h-100" src="img/thumbnail/mostaql2.png" alt="">
                                    <time>10:25</time>
                                    <i class="fa fa-play fa-2x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>أفضل النصائح لاختيار أفضل المستقلين والحفاظ على معدل توظيف مرتفع</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>قبل 4 أشهر</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-2">
                                    <img src="img/mostaql.png" width="30" alt="" class="search-img rounded-circle">
                                    <span class="card-text">مستقل</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                        <a href="watch.html">
                            <div class="card-icons">
                                <img class="w-100 h-100" src="img/thumbnail/khamsat3.png" alt="">
                                <time>13:02</time>
                                <i class="fa fa-play fa-2x"></i>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>خطوات بسيطة للتسجيل بموقع خمسات والبدء بربح المال</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>200 مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-0">
                                    <img src="img/khamsat.jpg" alt="" width="30" class="search-img rounded-circle">
                                    <span class="card-text">خمسات</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="watch.html">
                                <div class="card-icons">
                                    <img class="w-100 h-100" src="img/thumbnail/khamsat1.png" alt="">
                                    <time>18:20</time>
                                    <i class="fa fa-play fa-2x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>تعلم كيف تقدم مهاراتك على موقع خمسات</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>954 مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-0">
                                    <img src="img/khamsat.jpg" width="30" alt="" class="search-img rounded-circle">
                                    <span class="card-text">خمسات</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                        <a href="watch.html">
                            <div class="card-icons">
                                <img class="w-100 h-100" src="img/thumbnail/mostaql.png" alt="">
                                <time>17:02</time>
                                <i class="fa fa-play fa-2x"></i>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>وظف أفضل المستقلين الموجودين في  الوطن العربي - مستقل</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>1000 مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-0">
                                    <img src="img/mostaql.png" width="30" alt="" class="search-img rounded-circle">
                                    <span class="card-text">مستقل</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                        <a href="watch.html">
                            <div class="card-icons">
                                <img class="w-100 h-100" src="img/thumbnail/php.jpg" alt="">
                                <time>13:22</time>
                                <i class="fa fa-play fa-2x"></i>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>دورة تطوير تطبيقات الويب باستخدام لغة PHP - أكاديمية حسوب</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>800 مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-0">
                                    <img src="img/ch-logo.png" width="30" alt="" class="search-img rounded-circle">
                                    <span class="card-text">أكاديمية حسوب</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-4">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="watch.html">
                                <div class="card-icons">
                                    <img class="w-100 h-100" src="img/thumbnail/app.jpg" alt="">
                                    <time>22:18</time>
                                    <i class="fa fa-play fa-2x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-block">
                                <a href="watch.html"><b><p>دورة تطوير تطبيقات الجوال باستخدام تقنيات الويب - أكاديمية حسوب</p></b></a>
                                <small class="text-muted">
                                    <i class="fas fa-film"></i> <span>400 مشاهدة</span>
                                </small>
                                <a href="channel.html" class="channel-img d-lg-block ml-3 ml-sm-0 mt-0">
                                    <img src="img/ch-logo.png" alt="" width="30" class="search-img rounded-circle">
                                    <span class="card-text">أكاديمية حسوب</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script src="{{ asset('js/watch.js')}}"></script>
    <script>
        document.getElementById("qualityPick").onchange = function() {changeQuality()};
        function changeQuality() {
            let video = document.getElementById("videoPlayer");
            curTime = video.currentTime;
            let selected = document.getElementById("qualityPick").value;

            if (selected == '1080') {
                source = document.getElementById("webm_source").src = "{{ asset('storage/'.$video_converted->webm_Format_1080) }}";
                source = document.getElementById("mp4_source").src = "{{ asset('storage/'.$video_converted->mp4_Format_1080) }}";
            }
            else if (selected == '720') {
                source = document.getElementById("webm_source").src = "{{ asset('storage/'.$video_converted->webm_Format_720) }}";
                source = document.getElementById("mp4_source").src = "{{ asset('storage/'.$video_converted->mp4_Format_720) }}";
            }
            else if (selected == '480') {
                source = document.getElementById("webm_source").src = "{{ asset('storage/'.$video_converted->webm_Format_480) }}";
                source = document.getElementById("mp4_source").src = "{{ asset('storage/'.$video_converted->mp4_Format_480) }}";
            }
            else if (selected == '360') {
                source = document.getElementById("webm_source").src = "{{ asset('storage/'.$video_converted->webm_Format_360) }}";
                source = document.getElementById("mp4_source").src = "{{ asset('storage/'.$video_converted->mp4_Format_360) }}";
            }
            else if (selected == '240') {
                source = document.getElementById("webm_source").src = "{{ asset('storage/'.$video_converted->webm_Format_240) }}";
                source = document.getElementById("mp4_source").src = "{{ asset('storage/'.$video_converted->mp4_Format_240) }}";
            }
            video.load();
            video.play();
            video.currentTime = curTime;

        }
    </script>
@endsection
