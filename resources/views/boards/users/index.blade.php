@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Board Users';
@endphp

@extends('layouts.backend.main', [
    'title' => 'Board Users | ' . config('app.name'),
    'sub_title' => $sub_title
])

@section('container')

@if(session('success'))
<script>
    $(function() {
        swal("Success!", "{{ session('success') }}", "success");
    });
</script>
@endif

@if(session('error'))
<script>
    $(function() {
        swal("Oops!", "{{ session('error') }}", "error");
    });
</script>
@endif

<div class="container-fluid">
    <div class="page-title">
        {{ Breadcrumbs::render('boards.users.index', $board) }}
    </div>
</div>

<div class="container-fluid">

    {{-- INVITE USER --}}
    <div class="card mb-3">
        <div class="card-header pb-0">
            <h5>Tambah User ke Board: <strong>{{ $board->title }}</strong></h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('boards.users.store', $board) }}">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Masukkan email user"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i data-feather="plus"></i> Tambah User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- USER LIST --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="80">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="javascript:void(0)"
                                   onclick="removeUser({{ $user->id }})"
                                   class="txt-danger">
                                    <i data-feather="trash"></i>
                                </a>

                                <form method="POST"
                                      action="{{ route('boards.users.destroy', [$board, $user]) }}"
                                      id="form-delete-{{ $user->id }}"
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada user di board ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('boards.index') }}"
               class="btn btn-light text-primary fw-semibold d-inline-flex align-items-center gap-2 shadow-sm mt-3"
               style="background-color:#f4f0ff;">
                <i data-feather="arrow-left"></i>
                Back to Boards
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function removeUser(userId) {
    swal({
        title: "Yakin?",
        text: "User akan dikeluarkan dari board ini",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((ok) => {
        if (ok) {
            document.getElementById('form-delete-' + userId).submit();
        }
    });
}
</script>
@endpush
