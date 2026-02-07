<?php

namespace App\Traits;

trait PermissionsAuthorizable{
    public function __construct(){
        $this->middleware('permission:Permission Access')->only("index","show");
        $this->middleware('permission:Permission Create')->only("create","store");
        $this->middleware('permission:Permission Update')->only("edit","update");
        $this->middleware('permission:Permission Delete')->only("destroy");
    }
}
