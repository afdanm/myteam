@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if(isset($article_categories_data)){
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $article_categories_data)->where('title', '!=', $breadcrumb->title)->last();
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
                    {{ isset($article_categories_data) ? Breadcrumbs::render(Request::route()->getName(), $article_categories_data)  : Breadcrumbs::render(Request::route()->getName()) }}
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
                        @isset($article_categories_data) @method('put') @endisset
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" @if(isset($article_categories_data) || !is_null(old('name'))) value="@if(isset($article_categories_data)){{old('name',$article_categories_data->name)}}@else{{old('name')}}@endif" @endif placeholder="Categories"  autofocus>
                                            @error('name')
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