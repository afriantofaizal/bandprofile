<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('post', 'PostController@index')->name('post.index');
Route::get('/post/{slug}', 'PostController@detail')->name('post.detail');

Route::get('post/category/{slug}', 'PostController@postByCategory')->name('category.post');
Route::get('post/tag/{slug}', 'PostController@postByTag')->name('tag.post');

Route::get('gallery', 'GalleryController@index')->name('gallery.index');

Route::get('/profile/{username}', 'AuthorController@profile')->name('author.profile');

Route::get('/search', 'SearchController@search')->name('search');

Auth::routes();

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function(){
    // admin panel
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('gallery', 'GalleryController');

    // post approval
    Route::get('/pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');

    // gallery approval
    Route::get('/pending/gallery', 'GalleryController@pending')->name('gallery.pending');
    Route::put('/gallery/{id}/approve', 'GalleryController@approval')->name('gallery.approve');

    // all author
    Route::get('/authors', 'AuthorController@index')->name('author.index');
    Route::delete('/authors/{id}', 'AuthorController@destroy')->name('author.destroy');

    // subscriber
    Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');

    //search tag
    Route::get('/searchTag', 'TagController@searchTag')->name('searchTag');

    //search category
    Route::get('/searchCategory', 'CategoryController@searchCategory')->name('searchCategory');

    // search post
    Route::get('/search', 'PostController@search')->name('search');
    Route::get('/searchPending', 'PostController@searchPending')->name('searchPending');

    // search gallery
    Route::get('/searchGall', 'GalleryController@searchGall')->name('searchGall');
    Route::get('/searchPendingGall', 'GalleryController@searchPendingGall')->name('searchPendingGall');
    
    //search subscriber
    Route::get('/searchsub', 'SubscriberController@searchsub')->name('searchsub');

    //search author
    Route::get('/searchAuthor', 'AuthorController@searchAuthor')->name('searchAuthor');

});

Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function(){
    // author panel
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostController');
    Route::resource('gallery', 'GalleryController');
    
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    // search post
    Route::get('/searchPostAuthor', 'PostController@searchPostAuthor')->name('searchPostAuthor');

    // search post
    Route::get('/searchGall', 'GalleryController@searchGall')->name('searchGall');
});