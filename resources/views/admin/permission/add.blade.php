@extends('layouts.admin')
@section('title')
Trang chủ
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Menu','key'=>'add'])
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
                <div class="col-md-12">
                    <form action="{{ route('admin.permission.store')}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label>Chọn tên Module</label>
                            <select name="module_parent" id="" class="form-control">
                                <option value="">Chọn tên Module</option>
                                @foreach(config('permissions.table_module') as $moduleItem)
                                <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @foreach(config('permissions.module_childrent') as $moduleItemChildrent)
                                <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox" name="module_childrent[]" value="{{ $moduleItemChildrent}}">
                                        {{ $moduleItemChildrent}}
                                    </label>
                                </div>
                               @endforeach
                            </div>
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