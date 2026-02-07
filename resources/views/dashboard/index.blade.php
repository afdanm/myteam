@php $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard' @endphp

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
<div class="col-sm-12">
  <div class="card">
    <div class="card-body typography">
      <h3>Welcome Back,<small class="text-muted">{{ auth()->user()->name }}</small></h3>
    </div>
  </div>
</div>
@endsection