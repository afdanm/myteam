@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    $breadcrumb_parent = Breadcrumbs::generate(
        Request::route()->getName(),
        $board,
        $card,
        $list ?? null
    )->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main', [
    'title' => 'Dashboard | '.config('app.name'),
    'sub_title' => $sub_title
])

@section('container')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                {{ Breadcrumbs::render(Request::route()->getName(), $board, $card, $list ?? null) }}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form class="form theme-form" method="post" action="{{ $action }}">
                    @isset($list) @method('put') @endisset
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="content">List Content</label>
                            <div class="col-sm-9">

                                @error('content')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="theme-form">
                                    <div class="mb-3">
                                        <textarea
                                            name="content"
                                            id="content"
                                            cols="30"
                                            rows="5"
                                        >{{ old('content', $list->content ?? '') }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a class="btn btn-danger" href="{{ $breadcrumb_parent->url }}">Back</a>
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
                    evt.editor.editable().on(
                        'contextmenu',
                        function (contextEvent) {
                            var path = evt.editor.elementPath();
                            if (!path.contains('table')) {
                                contextEvent.cancel();
                            }
                        },
                        null,
                        null,
                        5
                    );
                }
            }
        });
    </script>
@endsection
