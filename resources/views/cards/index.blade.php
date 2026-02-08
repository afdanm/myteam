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
                <a href="{{ route('boards.cards.edit', [$board, $card]) }}" class="txt-info">
                    <i data-feather="edit-3"></i>
                </a>

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

                    <div class="btn-showcase mt-3">
                        <a class="btn btn-primary"
                           href="{{ route('boards.cards.create', $board) }}">
                            <i data-feather="plus"></i>
                            Create New Card
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
