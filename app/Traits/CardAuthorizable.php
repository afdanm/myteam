<?php

namespace App\Traits;

trait CardAuthorizable{
    public function __construct(){
        $this->middleware('permission:Card Access')->only("index","show");
        $this->middleware('permission:Card Create')->only("create","store");
        $this->middleware('permission:Card Update')->only("edit","update");
        $this->middleware('permission:Card Delete')->only("destroy");
    }
}
