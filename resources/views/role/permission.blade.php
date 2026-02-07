@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
    $breadcrumb_parent = Breadcrumbs::generate(Request::route()->getName(), $role)->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main', ['title' => 'Dashboard | '.config('app.name'), 'sub_title' => $sub_title])

@section('container')
    <?php
        function childPermission($permission_groups,$role) {
            foreach($permission_groups as $permission_group){
                ?>
                    <li data-jstree="{&quot;opened&quot;:false}">{{ $permission_group->name }}
                        <?php
                            if(ISSET($permission_group->child) || ISSET($permission_group->permissions)) {
                                echo "<ul>"; 
                                if(ISSET($permission_group->child)){
                                    childPermission($permission_group->child,$role); 
                                }
                                if(ISSET($permission_group->permissions)){
                                    foreach($permission_group->permissions as $permission){
                                        ?>
                                            <li data-jstree="{&quot;selected&quot;:{{ $role->hasPermissionTo($permission->name) ? "true" : "false" }},&quot;type&quot;:&quot;file&quot;}" id="esto-<?=$permission->id?>"><?=$permission->name?></li>
                                        <?php
                                    }
                                }
                                echo "</ul>";
                            }
                        ?>
                    </li>
                <?php              
            }
        }
    ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    {{ Breadcrumbs::render(Request::route()->getName(),$role) }}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form method="post" action="{{ $action }}">
                        @csrf   
                        <div class="card-body">
                            <div id="treecheckbox2">
                                <ul>
                                    <li data-jstree="{&quot;opened&quot;:true}">Permission
                                        <ul>
                                            <?php childPermission($permission_groups,$role); ?>
                                            <?php
                                                if(ISSET($permissions)){
                                                    foreach($permissions as $permission){
                                                        ?>
                                                            <li data-jstree="{&quot;selected&quot;:{{ $role->hasPermissionTo($permission->name) ? "true" : "false" }},&quot;type&quot;:&quot;file&quot;}" id="esto-<?=$permission->id?>"><?=$permission->name?></li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <input type="hidden" name="permission" id="esto" />

                            <div class="card-footer text-end">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="javascript:void(0)" onclick="submitMe()" class="btn btn-primary">Submit</a>
                                    <a class="btn btn-danger" href="{{ $breadcrumb_parent->url }}">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        jQuery(function($) {
            $('#treecheckbox2').jstree({
                'plugins': ["wholerow", "checkbox", "types"],
                'core' : {
                    'themes' : {
                        'responsive': false
                    }
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder text-warning"
                    },
                    "file" : {
                        "icon" : "fa fa-file  text-info"
                    }
                },
            });
            
        });

        function submitMe() {
            var checked_ids = [];
            var selectedNodes = $('#treecheckbox2').jstree("get_selected", true);
            $.each(selectedNodes, function() {
                var temp_id = this.id;
                if(temp_id.substring(0, 4) == "esto"){
                    checked_ids.push(temp_id.substring(5, temp_id.length));
                }                
            });
            
            $("#esto").val(checked_ids.join(","));
            $('form').submit();
        }
        
    </script>
@endsection