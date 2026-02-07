@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if(isset($menu_data)){
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $menu_data)->where('title', '!=', $breadcrumb->title)->last();
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
                    {{ isset($menu_data) ? Breadcrumbs::render(Request::route()->getName(), $menu_data)  : Breadcrumbs::render(Request::route()->getName()) }}
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
                        @isset($menu_data) @method('put') @endisset
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Menu</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu" type="text" @if(isset($menu_data) || !is_null(old('nama_menu'))) value="@if(isset($menu_data)){{old('nama_menu',$menu_data->nama_menu)}}@else{{old('nama_menu')}}@endif" @endif placeholder="Menu" required autofocus>
                                            @error('nama_menu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Parent</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12 @error('menu_id') is-invalid @enderror" name="menu_id">
                                                <option value=""> --Choose Parent Menu-- </option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}"  @if(isset($menu_data)) @if($menu_data->menu_id==$menu->id) selected @endif @else @if(old('menu_id')==$menu->id) selected @endif @endif >{{ $menu->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                            @error('menu_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Icon</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('icon') is-invalid @enderror" name="icon" type="text" @if(isset($menu_data) || !is_null(old('icon'))) value="@if(isset($menu_data)){{old('icon',$menu_data->icon)}}@else{{old('icon')}}@endif" @endif placeholder="Icon">
                                            @error('icon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Permission Group</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12 @error('permission_group_id') is-invalid @enderror" name="permission_group_id">
                                                <option value=""> --Choose Permission Group-- </option>
                                                @foreach ($permissiongroups as $permissiongroup)
                                                    <option value="{{ $permissiongroup->id }}"  @if(isset($menu_data)) @if($menu_data->permission_group_id==$permissiongroup->id) selected @endif @else @if(old('permission_group_id')==$permissiongroup->id) selected @endif @endif >{{ $permissiongroup->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permission_group_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Link</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('href') is-invalid @enderror" name="href" type="text" @if(isset($menu_data) || !is_null(old('href'))) value="@if(isset($menu_data)){{old('href',$menu_data->href)}}@else{{old('href')}}@endif" @endif placeholder="Link">
                                            @error('href')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Sort</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('sort') is-invalid @enderror" name="sort" type="text" @if(isset($menu_data) || !is_null(old('sort'))) value="@if(isset($menu_data)){{old('sort',$menu_data->sort)}}@else{{old('sort')}}@endif" @endif placeholder="Sort" required>
                                            @error('sort')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <div class="form-check form-check-inline radio radio-primary @error('status') is-invalid @enderror">
                                                <input class="form-check-input @error('status') is-invalid @enderror" id="status-active" type="radio" name="status" value="1" @if(isset($menu_data)) @if($menu_data->status == "1") checked @endif @else @if(old('status')=="1") checked @endif @endif >
                                                <label class="form-check-label mb-0" for="status-active">Avtive</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary @error('status') is-invalid @enderror">
                                                <input class="form-check-input @error('status') is-invalid @enderror" id="status-disable" type="radio" name="status" value="0" @if(isset($menu_data)) @if($menu_data->status == "0") checked @endif @else @if(old('status')=="0") checked @endif @endif >
                                                <label class="form-check-label mb-0" for="status-disable">Disable</label>
                                            </div>
                                            @error('status')
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