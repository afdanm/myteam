@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
    $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $article_data)->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')

@if(session()->has('success'))
    <script>
        $(document).ready(function() {
            swal("Succses!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@php
    $published_at = strtotime($article_data->published_at)
@endphp
    
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                {{ Breadcrumbs::render(Request::route()->getName(), $article_data) }}
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="blog-single">
                <div class="blog-box blog-details"><img class="img-fluid w-100" src="{{ asset('storage/'.$article_data->image_path) }}" alt="blog-main">
                    <div class="blog-details">
                        <ul class="blog-social">
                            <li>{{ \Carbon\Carbon::parse($article_data->published_at)->isoFormat('dddd, D MMMM Y') }}</li>
                            <li><i class="icofont icofont-files"></i>{{ $article_data->category->name }}</li>
                            <li><i class="icofont icofont-user"></i>{{ $article_data->author->name }}</li>
                            <li><a class="btn btn-danger" href="{{ $breadcrumb_parent->url }}">Back</a></li>
                        </ul>
                        <h4>{{ $article_data->title }}</h4>
                        <div class="single-blog-content-top">{!! $article_data->content !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection