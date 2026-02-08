<?php

namespace App\Traits;

trait BoardAuthorizable{
    public function __construct(){
        $this->middleware('permission:Board Access')->only("index","show");
        $this->middleware('permission:Board Create')->only("create","store");
        $this->middleware('permission:Board Update')->only("edit","update");
        $this->middleware('permission:Board Delete')->only("destroy");
    }
}
