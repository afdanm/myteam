@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
    $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $user)->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    {{ Breadcrumbs::render(Request::route()->getName(),$user) }}
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
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">

                                    <div class="mb-2 row">
                                        <label class="col-sm-3 col-form-label">Roles</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-multiple col-sm-12 @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name)?'selected':'' }} >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('roles')
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