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
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Article</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Publisehd at</th>
                                    @canany(['Article Detail', 'Article Update', 'Article Delete'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td><img class="img-fluid me-3 b-r-10" src="{{ asset('storage/'.$article->image_path) }}" style="max-height: 150px; max-width: 150px;" alt=""></td>
                                        <td>
                                            <h6> {{ $article->title }} </h6>
                                            <span>{{ $article->excerpt }}</span>
                                        </td>
                                        <td>{{ $article->category->name }}</td>
                                        <td>{{ $article->author->name }}</td>
                                        <td class="font-success">{{ \Carbon\Carbon::parse($article->published_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                        @canany(['Article Detail', 'Article Category Update', 'Article Category Delete'])
                                            <td>
                                                @can('Article Detail')
                                                    <a href="{{ url("/article/".$article->slug) }}" class="txt-primary"><i data-feather="eye"></i></a>
                                                @endcan
                                                @can('Article Category Update')
                                                    <a href="{{ url("/article/".$article->slug."/edit") }}" class="txt-info"><i data-feather="edit-3"></i></a>
                                                @endcan
                                                @can('Article Category Delete')
                                                    <form method="post" action="{{ url("/article/".$article->slug) }}" id="form-delete-{{ $loop->iteration }}" class="d-inline">
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

                    @can('Article Category Create')
                        <div class="btn-showcase" style="margin-top:20px;">
                            <div class="left-header col horizontal-wrapper">
                                <ul class="horizontal-menu">
                                    <li class="mega-menu outside">
                                        <a class="nav-link" href="{{ url("/article/create") }}"><i data-feather="plus"></i><span>Create New Article Categories</span></a>
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