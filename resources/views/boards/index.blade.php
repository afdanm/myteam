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
                                    <th>Title</th>
                                    <th>Description</th>
                                    @canany(['Board Update', 'Board Delete'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boards as $board)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $board->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($board->description), 100) }}</td>
                                        @canany(['Board Update', 'Board Delete'])
                                            <td>
                                                {{-- View Cards --}}
                                                <a href="{{ route('boards.cards.index', $board) }}" class="txt-primary">
                                                    <i data-feather="layers"></i>
                                                </a>

                                                @can('Board Update')
                                                    <a href="{{ url("/boards/".$board->slug."/edit") }}" class="txt-info">
                                                        <i data-feather="edit-3"></i>
                                                    </a>
                                                @endcan

                                                @can('Board Delete')
                                                    <form method="post" action="{{ url("/boards/".$board->slug) }}" id="form-delete-{{ $loop->iteration }}" class="d-inline">
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
                                                @endcan

                                                <a href="{{ route('boards.chat', $board) }}" class="txt-success" title="Chat Board">
                                                    <i data-feather="message-circle"></i>
                                                </a>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @can('Board Create')
                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="{{ url("/boards/create") }}"><i data-feather="plus"></i><span>Create New Board    </span></a>
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