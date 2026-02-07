<?php

namespace App\Traits;

trait MenusAuthorizable{
    public function __construct(){
        $this->middleware('permission:Menu Access')->only("index","show");
        $this->middleware('permission:Menu Create')->only("create","store");
        $this->middleware('permission:Menu Update')->only("edit","update");
        $this->middleware('permission:Menu Delete')->only("destroy");
    }
}
