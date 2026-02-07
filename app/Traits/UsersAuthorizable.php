<?php

namespace App\Traits;

trait UsersAuthorizable{
    public function __construct(){
        $this->middleware('permission:User Access')->only("index");
        $this->middleware('permission:User Create')->only("create","store");
        $this->middleware('permission:User Detail')->only("show");
        $this->middleware('permission:User Update')->only("edit","update");
        $this->middleware('permission:User Banned')->only("destroy");
        $this->middleware('permission:User Role Create')->only("role","roleaction");
    }
}
