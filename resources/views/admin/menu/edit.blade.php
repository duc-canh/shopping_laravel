@extends('layouts.admin')

@section('title')
Trang chủ
@endsection

@section('content')
<div class="content-wrapper">
  
   @include('partials.content-header',['name'=>'Menu','key'=>'edit'])
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
            <form action="{{ route('admin.menu.update',['id'=>$menu->id])}}" method="Post">
              @csrf
                <div class="form-group">
                    <label >Tên Menu</label>
                    <input name="name" value="{{ $menu->name }}" class="form-control">
                   
                </div>
                <div class="form-group">
                    <label >Chọn Menu cha</label>
                    <select name="parent_id" id="" class="form-control">
                        <option value="0">Chọn Menu cha</option>
                        {!! $optionSelect !!}
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