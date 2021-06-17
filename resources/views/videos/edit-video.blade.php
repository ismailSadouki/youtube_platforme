@extends('layouts.main')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/videos/uploader.css')}}">
@endsection
@section('title')
    <h4 class="py-5"> تعديل بيانات الفيديو </h4>    
@endsection

@section('content')
<div class="container">
    <div class="justify-content-center mt-3">
        <div class="card mb-2 cold-md-8">
            <div class="card-header text-center">
                رفع فيديو جديد
            </div>
            <div class="card-body">
                <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">عنوان الفيديو</label>
                        <input type="text" name="title" id="title"   class="form-control @error('title') is-invalid @enderror" value="{{$video->title}}">
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
                        <img class="col-2" width="100" height="100" id="cover-image-thumb"  src="{{ asset('storage/'.$video->image_path) }}">
                        <span class="input-name col-6"></span>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">عدل</button>
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
    </script>
@endsection