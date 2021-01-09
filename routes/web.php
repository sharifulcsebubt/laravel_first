<?php

use Illuminate\Support\Facades\Route;


Route::get('/','Homecontroller@index');


Route::get('/aboutus','HelloController@about')-> name('about');
Route::get(('/android'),'HelloController@android')-> name('android');




//category group
Route::get('add/category','HelloController@AddCategory')-> name('add.category');
Route::get('all/category','HelloController@AllCategory')-> name('all.category');
Route::post('store/category','HelloController@StoreCategory')-> name('store.category');

Route::get('view/category/{id}','HelloController@ViewCategory');
Route::get('delete/category/{id}','HelloController@DeleteCategory');
Route::get('edit/category/{id}','HelloController@EditCategory');

Route::post('update/category/{id}','HelloController@UpdateCategory');

//write post
Route::get('/write_post','PostController@WritePost')-> name('write_post');
Route::post('store/post','PostController@StorePost')-> name('store.post');
Route::get('all/post','PostController@AllPost')-> name('all.post');

//view post
Route::get('view/post/{id}','PostController@ViewPost');
//edit post
Route::get('edit/post/{id}','PostController@EditPost');
//update post
Route::post('update/post/{id}','PostController@UpdatePost');
//delete post
Route::get('delete/post/{id}','PostController@DeletePost');



