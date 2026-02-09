<?php

namespace App\Traits;

trait ListAuthorizable{
    public function __construct(){
        $this->middleware('permission:List Access')->only("index","show");
        $this->middleware('permission:List Create')->only("create","store");
        $this->middleware('permission:List Update')->only("edit","update");
        $this->middleware('permission:List Delete')->only("destroy");
    }
}
