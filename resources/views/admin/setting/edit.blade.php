@extends('layouts.admin')

@section('title')
Setting
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header',['name'=>'Setting','key'=>'edit'])
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
                    <form action="{{ route('admin.setting.store',['id'=>$setting->id])}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label>Config Key</label>
                            <input name="config_key" class="form-control" value="{{ $setting->config_key}}">
                        </div>
                        @if(request()->type === 'text')
                        <div class="form-group">
                            <label>Config Value</label>
                            <input name="config_value" class="form-control" value="{{ $setting->config_value}}">
                        </div>
                        @elseif(request()->type === 'textarea')
                        <div class="form-group">
                            <label>Config Value</label>
                            <textarea name="config_value" class="form-control rows=3">{{ $setting->config_value}}</textarea>
                        </div>
                        
                        @endif
                        <div class="form-group">
                            <label>Type</label>
                            <input name="type" readonly class="form-control" value="{{ $setting->type}}">
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