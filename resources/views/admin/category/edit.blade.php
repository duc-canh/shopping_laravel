@extends('layouts.admin')

@section('title')
Trang chủ
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @include('partials.content-header',['name'=>'Category','key'=>'edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-6">
            <form action="{{ route('admin.category.update',['id'=>$category->id])}}" method="Post">
              @csrf
                <div class="form-group">
                    <label >Tên danh mục</label>
                    <input name="name" value="{{ $category->name }}" class="form-control">
                   
                </div>
                <div class="form-group">
                    <label >Chọn danh mục cha</label>
                    <select name="parent_id" id="" class="form-control">
                        <option value="0">Chọn danh mục cha</option>
                      {!! $htlmOption !!}
                    </select>
                </div>
              
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
       
     </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
@endsection