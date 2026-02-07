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
                        <table class="stripe" id="table-user">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    @canany(['User Update', 'User Banned', 'User Role Create'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    @can('User Create')
                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="/user/create"><i data-feather="plus"></i><span>Create New User</span></a>
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
@section('javascript')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
<script>
   $(function () {

        var table = $('#table-user').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            language: {
                "processing": "<i class='fa fa-refresh fa-spin'></i><br>Loading..... Please Wait"
            },
            ajax: "{{ route('user.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                },
                {data: 'username', name: 'username'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className:'text-center'
                },
            ],
            order:[
                [1,"desc"]
            ],
            fnDrawCallback:function(s){
                feather.replace();
            },
            dom:"Bfrtip",
            buttons:[
                {
                    extend:'excel',
                    className:'btn btn-danger'
                }
            ]
        });
    });
</script>
@endsection
