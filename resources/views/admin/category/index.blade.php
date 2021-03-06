@extends('layouts.admin')

@section('title')
Trang chủ
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Category','key'=>'List'])
    @if(session('success'))
    <div class="alert alert-success col-md-3">
        {{ session('success') }}
    </div>
    @endif
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @can('delete_category')
                    <a href="{{ route('admin.category.add')}}" class="btn btn-success float-right m-2">Add</a>
                    @endcan
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="col-md-3">STT</th>
                                <th scope="col" class="col-md-6">Tên danh mục</th>
                                <th scope="col" class="col-md-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @can('update_category')
                                    <a href="{{ route('admin.category.edit',['id'=>$category->id])}}"
                                        class="btn btn-success">Edit</a>
                                    @endcan
                                    @can('delete_category')
                                    <a href="{{ route('admin.category.delete',['id'=>$category->id])}}"
                                        class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {!! $categories->links() !!}
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