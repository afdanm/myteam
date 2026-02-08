@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if(isset($boards)){
        $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $boards)->where('title', '!=', $breadcrumb->title)->last();
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
                    {{ isset($boards) ? Breadcrumbs::render(Request::route()->getName(), $boards)  : Breadcrumbs::render(Request::route()->getName()) }}
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
                        @isset($boards) @method('put') @endisset
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="title">Board Title</label>
                                        <div class="col-sm-9">
                                            <input
                                                class="form-control @error('title') is-invalid @enderror"
                                                name="title"
                                                id="title"
                                                type="text"
                                                value="{{ isset($boards) ? old('title', $boards->title) : old('title') }}"
                                                placeholder="Board Title"
                                                autofocus>
                                            @error('title') 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="description">Description</label>
                                        <div class="col-sm-9">
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                            <div class="theme-form">
                                                <div class="mb-3">
                                                    <textarea name="description" id="description" cols="30" rows="10">{{ (isset($boards))? old('description',$boards->description) : old('description') }}</textarea>
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
        CKEDITOR.replace('description', {
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