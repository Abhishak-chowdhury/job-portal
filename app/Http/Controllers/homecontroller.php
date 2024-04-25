<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PostJob;
class homecontroller extends Controller
{
    public function index(){
        $categories=Category::where('id','>',0)->with('postJobcount')->get();
        $jobs=PostJob::where('status','=',1)->take(6)->get();
        $latest_jobs=PostJob::where('status','=',1)->orderBy('id','DESC')->take(6)->get();
        $data=compact("categories",'jobs','latest_jobs');
        return view("frontpages.index",$data);
    }
}
