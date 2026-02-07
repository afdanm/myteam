<?php

namespace App\Traits;

trait RolesAuthorizable{
    public function __construct(){
        $this->middleware('permission:Role Access')->only("index");
        $this->middleware('permission:Role Create')->only("create","store");
        $this->middleware('permission:Role Detail')->only("show","showaction");
        $this->middleware('permission:Role Update')->only("edit","update");
        $this->middleware('permission:Role Delete')->only("destroy");
    }
}
