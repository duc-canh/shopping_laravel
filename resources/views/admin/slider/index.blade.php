@extends('layouts.admin')

@section('title')
Trang chủ
@endsection
@section('js')
<script src="/vendors/sweetAlert/sweetalert2@11.js"></script>
<script src="/adminpb/product/index/list.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Slider','key'=>'List'])
    @if(session('success'))
    <div class="alert alert-success col-md-3">
        {{ session('success') }}
    </div>
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.slider.add')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{ $slider->id }}</th>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->description }}</td>
                                <td><img width="50px" height="20px" style="object-fit:cover" src="{{ $slider->image_path }}" alt=""></td>
                                <td>
                                    <a href="{{ route('admin.slider.edit',['id'=>$slider->id])}}"
                                        class="btn btn-success">Edit</a>
                                    <a href="" data-url="{{ route('admin.slider.delete',['id'=>$slider->id])}}"
                                        class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {!! $sliders->links() !!}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
@endsection