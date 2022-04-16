<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{

    
    public function index(){
        $posts = Post::paginate(8);
        return view('posts.index', [
            // 'allPosts' => $this->posts,
            'allPosts' => $posts,
        ]);
    
    }
    public function create(){
        
        $users = User::all();
        return view('posts.create', [
            'users' => $users,
        ]);    
    }
    public function store(){
        
        $data = request()->all();
        //insert into database
        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                // 'user_id' => $data['post_creator'],
            ]
        );
        return to_route('posts.index');
    }
    public function show($post) {
        $post = Post::find($post);

        return view('posts.show', [
            'posts' => $post,
        ]);
    }
     public function edit($id) {
        $post = Post::find($id);
        return view('posts.edit', [
            'post' => $post,
            'users' => User::all(),
        ]);
    }

    public function update($post)
    {
        $post = Post::find($post);
        $data = request()->all();

        $post->title = $data['title'];
        $post->description = $data['description'];
        // $post['user_id'] = $data['post_creator'];

        $post->update();
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $singlePost = Post::findOrFail($id);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }

}