<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Homecontroller extends Controller
{
    public function index()
    {
    	$post=DB::table('post')
		->join('categories','post.category_id','categories.id')
		->select('post.*','categories.name','categories.address')
		->paginate(3);


    	return view('pages.index',compact('post'));
    }
}
