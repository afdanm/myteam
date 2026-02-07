@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if(isset($role_data)){
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $role_data)->where('title', '!=', $breadcrumb->title)->last();
    } else {
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName())->where('title', '!=', $breadcrumb->title)->last();
    }
@endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    {{ isset($role_data) ? Breadcrumbs::render(Request::route()->getName(), $role_data)  : Breadcrumbs::render(Request::route()->getName()) }}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form class="form theme-form" method="post" action="{{ $action }}">
                        @isset($role_data) @method('put') @endisset
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" @if(isset($role_data) || !is_null(old('name'))) value="@if(isset($role_data)){{old('name',$role_data->name)}}@else{{old('name')}}@endif" @endif placeholder="Role" required autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Guard Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" type="text" @if(isset($role_data) || !is_null(old('guard_name'))) value="@if(isset($role_data)){{old('guard_name',$role_data->guard_name)}}@else{{old('guard_name')}}@endif" @else value="web" @endif required>
                                            @error('guard_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <a class="btn btn-danger" href="{{ $breadcrumb_parent->url }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection