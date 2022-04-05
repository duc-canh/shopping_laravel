@extends('layouts.admin')
@section('title')
Trang chủ
@endsection
@section('js')
<script>
    $(function(){
        $('.checkbox_wrapper').on('click',function(){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
        });
        $('.checkall').on('click',function(){
            $(this).parents().find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
            $(this).parents().find('.checkbox_wrapper').prop('checked',$(this).prop('checked'));
        });
    });
</script>
@endsection
@section('css')
<style>
input[type='checkbox']{
    transform:scale(1.2);
}
</style>
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
                <div class="col-md-12">
                    <form action="{{ route('admin.role.update',['id'=>$role->id])}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input name="name" class="form-control" value="{{ $role->name }}"
                                   >
                            </div>

                            <div class="form-group">
                                <label>Nhập mô tả vai trò</label>
                                <textarea class="form-control" name="display_name" rows="3"
                                    >{{ $role->display_name}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="checkbox" class="checkall">
                            <label >Check All</label>
                        </div>
                        @foreach($permissionParent as $permissionParentItem)
                        <div class="col-md-12">
                            <div class="card text-black mb-3 col-md-12">
                                <div class="card-header bg-success">
                                    <input type="checkbox" class="checkbox_wrapper">
                                    <label for="">Module {{ $permissionParentItem->name}}</label>
                                </div>
                                <div class="row col-md-12">
                                    @foreach($permissionParentItem->permissionsChildrent as $permissionsChildrentItem)
                                    <div class="card-body col-md-3">
                                        <input class="checkbox_childrent" name="permission_id[]"
                                        {{ $permissionChecked->contains('id', $permissionsChildrentItem->id) ? 'checked':''}}
                                        style="margin-left:5px;margin-top:6px;" type="checkbox"
                                         value="{{ $permissionsChildrentItem->id }}">
                                        <label class="card-title">{{ $permissionsChildrentItem->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
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