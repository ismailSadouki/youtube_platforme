@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/videos/uploader.css')}}">
@endsection
@section('title')
    <h4 class="py-5">رفع فيديو جديد</h4>    
@endsection

@section('content')
<div class="container">
    <div class="justify-content-center mt-3">
        <div class="card mb-2 cold-md-8">
            <div class="card-header text-center">
                رفع فيديو جديد
            </div>
            <div class="card-body">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">عنوان الفيديو</label>
                        <input type="text" name="title" id="title"  value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group file-area">
                        <label for="image">صورة الغلاف</label>
                        <input type="file"  id="image"  class="form-control @error('image') is-invalid @enderror"
                                            name="image"
                                            accept="image/*"
                                            onchange="readCoverImage(this);">
                        <div  class="input-title">اسحب الصورة الى هنا او انقر للاختيار يدويا</div>
                        @error('image')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <img class="col-2" width="100" height="100" id="cover-image-thumb" style="display: none">
                        <span class="input-name col-6"></span>
                    </div>

                    <div class="form-group file-area">
                        <label for="video">مقطع الفيديو</label>
                        <input type="file"  id="video"  class="form-control @error('video') is-invalid @enderror"
                                            name="video"
                                            accept="video/*"
                                            onchange="readVideo(this);">
                        <div class="input-title">اسحب مقطع الفيديو الى هنا او انقر للاختيار يدويا</div>
                        @error('video')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                            <span class="video-name mb-4"></span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">رفع الفيديو</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#cover-image-thumb').attr('src', e.target.result);
                    document.getElementById('cover-image-thumb').style.display="block";
                };

                reader.readAsDataURL(input.files[0]);
                $('.input-name').html(input.files[0].name);
            }
        }

        function readVideo(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.readAsDataURL(input.files[0]);
                $(".video-name").html('\
                    <div class="alert alert-primary">\
                        تم اختيار مقطع الفيديو بنجاح '+input.files[0].name+'\
                    </div>'
                );
            }
        }
    </script>
@endsection