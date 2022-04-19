<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index()
    {
        return Post::all();
    }

    public function show($postId)
    {
        return Post::find($postId);
    }
    // public function store(StorePostRequest $request)
    // {
    //     return 'we are in store';
    // }

}
