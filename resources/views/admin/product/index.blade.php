@extends('layouts.admin')

@section('title')
Trang chủ
@endsection

@section('content')
<div class="content-wrapper">
  
    @include('partials.content-header',['name'=>'Product','key'=>'List'])
  
    @if(session('success'))
                            <div class="alert alert-success col-md-3">
                                {{ session('success') }}
                            </div>
   @endif
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
             <a href="{{ route('admin.product.add')}}" class="btn btn-success float-right m-2">Add</a>
             
         </div>
         <div class="col-md-12">
            <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" >STT</th>
                        <th scope="col" >Tên Sản Phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col" >Hình ảnh</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                        <tr>
                          <th scope="row">{{ $product->id }}</th>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->feature_image_path }}</td>
                          <td>{{ $product->category_id }}</td>
                          <td>
                            <a href="{{ route('admin.category.edit',['id'=>$product->id])}}" class="btn btn-success">Edit</a>
                            <a href="{{ route('admin.category.delete',['id'=>$product->id])}}" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
             </table>
        </div>
        <div class="col-md-12">
          {!! $products->links() !!}
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