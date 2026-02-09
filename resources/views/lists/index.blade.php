@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
@endphp

@extends('layouts.backend.main', [
    'title' => 'Dashboard | '.config('app.name'),
    'sub_title' => $sub_title
])

@section('container')

@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                {{ Breadcrumbs::render(Request::route()->getName(), $board, $card) }}
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
                                    <th>content</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lists as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($list->content), 100) }}</td>
                                        <td>
                                            <a href="{{ route('boards.cards.lists.edit', [$board, $card, $list]) }}"
                                               class="txt-info">
                                                <i data-feather="edit-3"></i>
                                            </a>

                                            <form method="post"
                                                  action="{{ route('boards.cards.lists.destroy', [$board, $card, $list]) }}"
                                                  id="delete-list-{{ $loop->iteration }}"
                                                  class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <a href="javascript:void(0)"
                                                   onclick="swal({
                                                       title: 'Are you sure?',
                                                       icon: 'warning',
                                                       buttons: true,
                                                       dangerMode: true,
                                                   }).then((willDelete) => {
                                                       if (willDelete) {
                                                           document.getElementById('delete-list-{{ $loop->iteration }}').submit();
                                                       }
                                                   });"
                                                   class="txt-danger">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No data available
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="{{ route('boards.cards.lists.create', [$board, $card]) }}"><i data-feather="plus"></i><span>Create New List    </span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
