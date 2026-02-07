@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
@endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    {{ Breadcrumbs::render(Request::route()->getName()) }}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form class="form theme-form" method="post" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">

                                    <div class="mb-3 row">
                                        <div class="col-12 row mb-3">
                                            <label class="col-sm-3 col-form-label" for="title">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title" id="title" class="form-control" value="@if(isset($title)){{old('title',$title)}}@else{{old('title')}}@endif">
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 row mb-3">
                                            <label class="col-sm-3 col-form-label" for="keyword">Keyword</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="keyword" id="keyword" class="form-control tags" value="@if(isset($keyword)){{old('keyword',$keyword)}}@else{{old('keyword')}}@endif">
                                                @error('keyword')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 row mb-3">
                                            <label class="col-sm-3 col-form-label" for="author">Author</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="author" id="author" class="form-control" value="@if(isset($author)){{old('author',$author)}}@else{{old('author')}}@endif">
                                                @error('author')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 row mb-3">
                                            <label class="col-sm-3 col-form-label" for="favicon">Favicon</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="favicon" id="favicon" class="form-control mb-1" onchange="previewImage()">
                                                <img class="img-preview img-fluid mt-3" src="{{ $favicon }}" alt="Gambar Favicon"  style="max-height: 36px; max-width: 36px;"/>
                                                @error('favicon')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 row mb-3">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" id="description" cols="30" rows="4" class="form-control @error('description') is-invalid @enderror">@if(isset($description)){{old('description',$description)}}@else{{old('description')}}@endif</textarea>
                                                <label class="col-form-label">Sisa Karakter : <span id="count"></span></label>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>

        $("#count").text((160 - $("#description").val().length));

        function previewImage(){
            const image = document.querySelector('#favicon');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

        $("#description").keyup(function(){
            $("#count").text((160 - $(this).val().length));
        });
    </script>
@endsection
