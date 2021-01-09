<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HelloController extends Controller
{
	public function about()
	{
		return view ('pages.about');
	}

	public function android()
	{
		return view ('pages.android');
	}

	public function AddCategory()
	{
		return view ('post.add_category');
	}

	public function StoreCategory(Request $request)
	{
		$validatedData = $request->validate([
    		'name' => ['required', 'unique:categories', 'max:40', 'min:4'],
    		'address' => ['required', 'max:100', 'min:4'],
		]);


		$data=array();
		$data['name']=$request->name;
		$data['address']=$request->address;
		$category=DB::table('categories')->insert($data);
		if ($category) {
			$notification=array(
				'messege'=>'Successfully category inserted!',
				'alert-type'=> 'success'
			);
			return Redirect()->route('all.category')->with($notification);
		}else{
			$notification=array(
				'messege'=>'Something want wrong!',
				'alert-type'=> 'error'
			);
			return Redirect()->back()->with($notification);
		}
	}
	
	public function AllCategory()
	{
		$category=DB::table('categories')->get();

		return view('post.all_category',compact('category'));
	}

	public function ViewCategory($id)
	{
		$category=DB::table('categories')->where('id',$id)->first();
		return view('post.categoryview')->with('cat',$category);
	}

    public function DeleteCategory($id)
    {
        $category=DB::table('categories')->where('id',$id)->delete();
        $notification=array(
        'messege'=>'Successfully Category Deleted!',
            'alert-type'=>'success'
        );
		return Redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
    	$category=DB::table('categories')->where('id',$id)->first();
    	return view('post.editcategory',compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
    	$validatedData = $request->validate([
    		'name' => ['required', 'max:40', 'min:4'],
    		'address' => ['required', 'max:100', 'min:4'],
		]);


		$data=array();
		$data['name']=$request->name;
		$data['address']=$request->address;
		$category=DB::table('categories')->where('id',$id)->update($data);
		if ($category) {
			$notification=array(
				'messege'=>'Successfully Category Updated!',
				'alert-type'=> 'success'
			);
			return Redirect()->route('all.category')->with($notification);
		}else{
			$notification=array(
				'messege'=>'Nothing to Update!',
				'alert-type'=> 'error'
			);
			return Redirect()->back()->with($notification);
		}
    }
}
