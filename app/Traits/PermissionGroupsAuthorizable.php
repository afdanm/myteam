<?php

namespace App\Traits;

trait PermissionGroupsAuthorizable{
    public function __construct(){
        $this->middleware('permission:Permission Group Access')->only("index","show");
        $this->middleware('permission:Permission Group Create')->only("create","store");
        $this->middleware('permission:Permission Group Update')->only("edit","update");
        $this->middleware('permission:Permission Group Delete')->only("destroy");
    }
}
