@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if(isset($article_data)){
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $article_data)->where('title', '!=', $breadcrumb->title)->last();
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
                    {{ isset($article_data) ? Breadcrumbs::render(Request::route()->getName(), $article_data)  : Breadcrumbs::render(Request::route()->getName()) }}
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
                        @isset($article_data) @method('put') @endisset
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select name="article_category_id" id="article_category_id" class="js-example-basic-single col-sm-12 @error('article_category_id') is-invalid @enderror">
                                                @foreach($categories as $category)
                                                    @if(isset($article_data) && $article_data->category->id == $category->id )
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                    @elseif(!is_null(old('article_category_id')) && old('article_category_id') == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('article_category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="title">Title</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('title') is-invalid @enderror" name="title" id="title" type="text" value="{{ (isset($article_data))? old('title',$article_data->title) : old('title') }}" placeholder="Title"  autofocus>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="published_at">Published at</label>
                                        <div class="col-sm-9">
                                            <input class="form-control datepicker-here digits @error('published_at') is-invalid @enderror" name="published_at" id="published_at" type="text" value="{{ (isset($article_data))? old('published_at',date('d-m-Y', strtotime($article_data->published_at))) : old('published_at') }}" placeholder="DD-MM-YYYY"   autocomplete="off" data-language="id">
                                            @error('published_at')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="highlite">Highlite</label>
                                        <div class="col-sm-9">
                                            <div class="media-body icon-state switch-outline">
                                                <label class="switch">
                                                    <input type="checkbox" name="highlite" id="highlite" {{ (isset($article_data))? (old('highlite',$article_data->highlite))? "Checked":"" : (old('highlite'))? "Checked":"" }}><span class="switch-state bg-success"></span>
                                                </label>
                                            </div>
                                            @error('highlite')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="tags" class="col-sm-3 col-form-label">Tags</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('tags') is-invalid @enderror tags" name="tags" id="tags" type="text" value="{{ (isset($article_data))? old('tags',$article_data->tags) : old('tags') }}" placeholder="Title" autocomplete="off">
                                            @error('tags')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="image">Image</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" onchange="previewImage()" placeholder="Dokumen"  autofocus>
                                            <img class="img-preview img-fluid mt-3" @isset($article_data) src="{{ asset('storage/'.$article_data->image_path) }}" @endisset style="max-height: 150px; max-width: 150px;"/>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="content">Content</label>
                                        <div class="col-sm-9">
                                            @error('content')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                            <div class="theme-form">
                                                <div class="mb-3">
                                                    <textarea name="content" id="content" cols="30" rows="10">
                                                    {{ (isset($article_data))? old('content',$article_data->content) : old('content') }}
                                                    </textarea>
                                                </div>
                                            </div>
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

@section('javascript')
    <script src="{{ asset('/assets/js/editor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/assets/js/editor/ckeditor/styles.js') }}"></script>
    <script>
        CKEDITOR.replace('content', {
            on: {
                contentDom: function (evt) {
                    // Allow custom context menu only with table elemnts.
                    evt.editor.editable().on('contextmenu', function (contextEvent) {
                        var path = evt.editor.elementPath();

                        if (!path.contains('table')) {
                            contextEvent.cancel();
                        }
                    }, null, null, 5);
                }
            }
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
