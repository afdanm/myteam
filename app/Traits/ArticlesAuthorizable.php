<?php

namespace App\Traits;

trait ArticlesAuthorizable{
    public function __construct(){
        $this->middleware('permission:Article Access')->only("index");
        $this->middleware('permission:Article Detail')->only("show");
        $this->middleware('permission:Article Create')->only("create","store");
        $this->middleware('permission:Article Update')->only("edit","update");
        $this->middleware('permission:Article Delete')->only("destroy");
    }
}
