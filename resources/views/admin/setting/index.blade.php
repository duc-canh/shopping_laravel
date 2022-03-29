@extends('layouts.admin')

@section('title')
Trang chủ
@endsection
@section('css')
<link rel="stylesheet" href="/adminpb/setting/index.css">
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Setting','key'=>'List'])
    @if(session('success'))
    <div class="alert alert-success col-md-3">
        {{ session('success') }}
    </div>
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group float-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            Add setting
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.setting.add') . '?type=text'}}">Text</a></li>
                            <li><a href="{{ route('admin.setting.add').'?type=textarea'}}">Textarea</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <th scope="row">{{ $setting->id }}</th>
                                <td>{{ $setting->config_key }}</td>
                                <td>{{ $setting->config_value }}</td>
                                <td>{{ $setting->type }}</td>
                                <td>
                                    <a href="{{ route('admin.setting.edit',['id'=>$setting->id]).'?type='. $setting->type}}"
                                        class="btn btn-success">Edit</a>
                                    <a href="{{ route('admin.setting.delete',['id'=>$setting->id])}}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {!! $settings->links() !!}
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