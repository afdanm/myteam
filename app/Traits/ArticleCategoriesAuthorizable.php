<?php

namespace App\Traits;

trait ArticleCategoriesAuthorizable{
    public function __construct(){
        $this->middleware('permission:Article Category Access')->only("index","show");
        $this->middleware('permission:Article Category Create')->only("create","store");
        $this->middleware('permission:Article Category Update')->only("edit","update");
        $this->middleware('permission:Article Category Delete')->only("destroy");
    }
}
