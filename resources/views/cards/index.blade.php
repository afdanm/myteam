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
                {{ Breadcrumbs::render(Request::route()->getName(), $board) }}
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
                                    <th>Name</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @forelse ($cards as $card)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $card->name }}</td>
                                            <td>
                                                {{-- View Lists --}}
                                                <a href="{{ route('boards.cards.lists.index', [$board, $card]) }}"
                                                class="txt-primary"
                                                title="View Lists">
                                                    <i data-feather="list"></i>
                                                </a>

                                                {{-- Edit Card --}}
                                                <a href="{{ route('boards.cards.edit', [$board, $card]) }}"
                                                class="txt-info"
                                                title="Edit Card">
                                                    <i data-feather="edit-3"></i>
                                                </a>

                                                {{-- Delete Card --}}
                                                <form method="post"
                                                    action="{{ route('boards.cards.destroy', [$board, $card]) }}"
                                                    id="form-delete-{{ $loop->iteration }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="javascript:void(0)"
                                                    onclick="swal({
                                                        title: 'Are you sure?',
                                                        text: 'Once deleted, you will not be able to data!',
                                                        icon: 'warning',
                                                        buttons: true,
                                                        dangerMode: true,
                                                    }).then((willDelete) => {
                                                        if (willDelete) {
                                                            document.getElementById('form-delete-{{ $loop->iteration }}').submit();
                                                        }
                                                    });"
                                                    class="txt-danger"
                                                    title="Delete Card">
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

                    @can('Board Create')
                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="{{ route('boards.cards.create', $board) }}"><i data-feather="plus"></i><span>Create New Board    </span></a>
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
