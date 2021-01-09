<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
	public function WritePost()
	{
		$category = DB::table('categories')->get();
		return view ('post.write_post',compact('category'));
	}

	public function StorePost(Request $request)
	{
		$validateData = $request->validate([
			'title' => 'required | max:1250',
			'details' => 'required',
			'image' => 'required | mimes:jpeg,png,jpg,gif,svg,PNG | max:2048'

		]);

		$data=array();
		$data['title']=$request->title;
		$data['category_id']=$request->category_id;
		$data['details']=$request->details;
		$image=$request->file('image');
		if ($image) {
			$image_name=hexdec(uniqid());
			$ext=strtolower($image->getClientOriginalExtension());
			$image_full_name=$image_name.'.'.$ext;
			$upload_path='public/frontend/image/';
			$image_url=$upload_path.$image_full_name;
			$success=$image->move($upload_path,$image_full_name);
			$data['image']=$image_url;
			DB::table('post')->insert($data);
			$notification=array(
				'messege'=>'Successfully Post Inserted',
				'alert_type'=>'success'
			);
			return Redirect()->back()->with($notification);
		}else{
			DB::table('post')->insert($data);
			$notification=array(
				'messege'=>'Successfully Post Inserted',
				'alert_type'=>'success'
			);
			return Redirect()->back()->with($notification);

		}

	}

	public function AllPost()
	{
		$post=DB::table('post')
		->join('categories','post.category_id','categories.id')
		->select('post.*','categories.name')
		->get();
		return view('post.allpost',compact('post'));

	}

	public function ViewPost($id)
	{
		$post=DB::table('post')
		->join('categories','post.category_id','categories.id')
		->select('post.*','categories.name')
		->where('post.id',$id)
		->first();
		return view('post.viewpost',compact('post'));
	}

	public function EditPost($id)
	{
		$category=DB::table('categories')->get();
		$post=DB::table('post')
		->where ('id',$id)
		->first();
		return view('post.editpost',compact('category','post'));
	}

	public function UpdatePost(Request $request,$id)
	{
		$validateData = $request->validate([
			'title' => 'required | max:1250',
			'details' => 'required',
			'image' => 'mimes:jpeg,png,jpg,gif,svg,PNG | max:2048'

		]);

		$data=array();
		$data['title']=$request->title;
		$data['category_id']=$request->category_id;
		$data['details']=$request->details;
		$image=$request->file('image');
		if ($image) {
			$image_name=hexdec(uniqid());
			$ext=strtolower($image->getClientOriginalExtension());
			$image_full_name=$image_name.'.'.$ext;
			$upload_path='public/frontend/image/';
			$image_url=$upload_path.$image_full_name;
			$success=$image->move($upload_path,$image_full_name);
			$data['image']=$image_url;
			unlink($request->old_photo);
			DB::table('post')->where('id',$id)->update($data);
			$notification=array(
				'messege'=>'Successfully Post Updated',
				'alert_type'=>'success'
			);
			return Redirect()->route('all.post')->with($notification);
		}else{
			$data['image']=$request->old_photo;
			DB::table('post')->where('id',$id)->update($data);
			$notification=array(
				'messege'=>'Successfully Post Updated',
				'alert_type'=>'success'
			);
			return Redirect()->route('all.post')->with($notification);

		}
	}

	public function DeletePost($id)
	{
		$post=DB::table('post')->where('id',$id)->first();
		$image=$post->image;

		$delete=DB::table('post')->where('id',$id)->delete();
		if ($delete) {
			unlink($image);
			$notification=array(
				'messege'=>'Successfully Deleted!',
				'alert_type'=>'success'
			);
			return Redirect()->back()->with($notification);

		}else{
			$notification=array(
				'messege'=>'Somethign want wrong!',
				'alert_type'=>'error'
			);
			return Redirect()->back()->with($notification);

		}
	}

}
