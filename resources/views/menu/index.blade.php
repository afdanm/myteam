@php $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard' @endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')

@if(session()->has('success'))
    <script>
        $(document).ready(function() {
            swal("Succses!", "{{ session('success') }}", "success");
        });
    </script>
@endif
    
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                {{ Breadcrumbs::render(Request::route()->getName()) }}
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="stripe" id="example-style-8">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Parent</th>
                                    <th>Icon</th>
                                    <th>Permission Group</th>
                                    <th>Link</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    @canany(['Menu Update', 'Menu Delete'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $menu->nama_menu }}</td>
                                        <td>@isset($menu->parent) {{ $menu->parent->nama_menu }} @endisset</td>
                                        <td>{{ $menu->icon }}</td>
                                        <td>@isset($menu->permissiongroup->name) {{ $menu->permissiongroup->name }} @endisset</td>
                                        <td>{{ $menu->href }}</td>
                                        <td>{{ $menu->sort }}</td>
                                        <td>{{ $menu->status }}</td>
                                        @canany(['Menu Update', 'Menu Delete'])
                                            <td>
                                                @can('Menu Update')
                                                    <a href="/menu/{{ $menu->id }}/edit" class="txt-info"><i data-feather="edit-3"></i></a>
                                                @endcan
                                                @can('Menu Delete')
                                                    <form method="post" action="/menu/{{ $menu->id }}" id="form-delete-{{ $loop->iteration }}" class="d-inline">
                                                        @csrf    
                                                        @method('delete')
                                                        <a href="javascript:void(0)" onclick="swal({ title: 'Are you sure?', text: 'Once deleted, you will not be able to data!', icon: 'warning', buttons: true, dangerMode: true, }).then((willDelete) => { if (willDelete) { document.getElementById('form-delete-{{ $loop->iteration }}').submit(); } });" class="txt-danger"><i data-feather="trash"></i></a>
                                                    </form>
                                                @endcan                                         
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @can('Menu Create')
                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="/menu/create"><i data-feather="plus"></i><span>Create New Menu</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endcan   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection