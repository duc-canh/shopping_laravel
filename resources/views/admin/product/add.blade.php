@extends('layouts.admin')

@section('title')
Trang chủ
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
<div class="content-wrapper">
  
   @include('partials.content-header',['name'=>'Product','key'=>'add'])
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
            <form action="{{ route('admin.product.store')}}" method="Post" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label >Tên Sản Phẩm</label>
                    <input name="name" class="form-control" placeholder="Nhập tên Sản phẩm">
                </div>
                <div class="form-group">
                    <label >Giá sản phẩm</label>
                    <input name="price" class="form-control" placeholder="Nhập giá Sản phẩm">
                </div>
                <div class="form-group">
                    <label >Ảnh đại diện SP</label>
                    <input type="file" name="feature_image_path" class="form-control">
                </div>
                <div class="form-group">
                    <label >Ảnh chi tiết SP</label>
                    <input type="file" multiple name="image_path[]" class="form-control">
                </div>
                <div class="form-group">
                    <label >Chọn danh mục</label>
                    <select name="parent_id" id="" class="form-control select2_init">
                        <option value="">Chọn danh mục</option>
                      {!! $htlmOption !!}
                    </select>
                </div>
                <div class="form-group">
                    <label >Nhâp tags cho sản phẩm</label>
                    <select class="form-control tags_select_choose" multiple="multiple">
                       
                    </select>
                </div>
                <div class="form-group">
                    <label >Nội dung</label>
                    <textarea name="content" class="form-control" rows="3"></textarea>
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
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $(".tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
        $(".select2_init").select2({
            placeholder: "Chọn danh mục",
            allowClear: true
        })
    })
</script>
@endsection