@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    $breadcrumb_parent = Breadcrumbs::generate(
        Request::route()->getName(),
        $board,
        $card ?? null
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
                {{ Breadcrumbs::render(Request::route()->getName(), $board, $card ?? null) }}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form class="form theme-form" method="post" action="{{ $action }}">
                    @isset($card) @method('put') @endisset
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="name">
                                Card Name
                            </label>
                            <div class="col-sm-9">
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $card->name ?? '') }}"
                                    placeholder="Card Name"
                                    autofocus>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                        <a class="btn btn-danger" href="{{ $breadcrumb_parent->url }}">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
