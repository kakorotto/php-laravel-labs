<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    public function index()
    {
        // return Post::all();
        return PostResource::collection(Post::all());

    }

    public function show($postId)
    {
        // return Post::find($postId);
        return new PostResource(Post::find($postId));
    }
    // public function store(StorePostRequest $request)
    // {
    //     return 'we are in store';
    // }
    public function store(StorePostRequest $request)
    {

    $data = $request->all();

    //store the request data in the db
    $post = Post::create([
        'title' => $data['title'],
        'description' => $data['description'],
        'user_id' => $data['post_creator'],
    ]);

    return new PostResource($post);
}
}
