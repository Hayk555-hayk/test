<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Redis;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    $data = json_encode(['title' => 'newPost->title', 'author' => 'newPost->author', 'publication_year' => 'newPost->publication_year']);
    $result = Redis::publish('channel:blog.posts', $data);
    echo $result;
    if ($result !== false) {
        echo "Message published successfully to $result subscribers.";
    } else {
        echo "Failed to publish message.";
    }

});


Route::resource('posts', PostController::class);
