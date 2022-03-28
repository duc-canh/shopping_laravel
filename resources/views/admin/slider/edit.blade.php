@extends('layouts.admin')
@section('title')
Trang chủ
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Slider','key'=>'edit'])
    @if(count($errors) > 0)
    @foreach($errors->all() as $err)
    <div class="alert alert-danger col-md-4">
        {{ $err}}
    </div>
    @endforeach
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.slider.update',['id'=>$slider->id])}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên Slider</label>
                            <input name="name" class="form-control" value="{{ $slider->name}}">
                        </div>
                        <div>
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="image_path">
                            <img width="50px" height="80px" style="object-fit:cover" src="{{ $slider->image_path }}" alt="">
                        </div>
                        <div class="form-group">
                            <label>Nhập mô tả</label>
                            <textarea class="form-control" name="description" rows="3">{{ $slider->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
@endsection