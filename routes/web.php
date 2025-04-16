<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;


// routes/web.php
Route::get("/", function() {
    $posts = Post::all();
    
    /* To filter posts by authenticated User comment the lined above and uncomment this "if" statement
    $posts = [];

    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    */
    return view('home', ["posts" => $posts]);
});

// User URLs
Route::post("/register", [UserController::class, "register"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::post("/login", [UserController::class, "login"]);

// Blog URLs
Route::post("/create-post", [PostController::class, "createPost"]);
Route::get("/edit-post/{post}", [PostController::class, "showEditScreen"]);
Route::put("/edit-post/{post}", [PostController::class, "updatePost"]);
Route::delete("/delete-post/{post}", [PostController::class, "deletePost"]);