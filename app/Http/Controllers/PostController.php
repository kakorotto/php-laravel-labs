<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;

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
    public function store(StorePostRequest $request){
        
        $data = request()->all();
        if ($request->hasFile('avatar')) {
            $filename = time() . $request->avatar->getClientOriginalName();
            // dd($filename);
            $request->avatar->storeAs('images', $filename, 'public');

        }
        //insert into database
       
        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                // 'user_id' => $data['post_creator'],
                'user_id' => $data['post_creator'],
                'avatar'=>$filename,
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

    public function update($post, Request $request)
    {

        // $post->title = $data['title'];
        // $post->description = $data['description'];
        // $post['user_id'] = $data['post_creator'];
        $post = Post::find($post);
        $data = request()->all();
        $post->title = $request->input('title');
        $post->user_id = $request->input('post_creator');
        $post->description = $request->input('description');
        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $extention = $file->getClientOriginalName();
            $filename = time() . $extention;
            $file->storeAs('images', $filename, 'public');
            $post->avatar = $filename;

        }
        $post->save();


        $post->update();
        // return to_route('posts.index');
        return redirect()->route('posts.index');

    }

    public function destroy($id)
    {
        $singlePost = Post::findOrFail($id);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }

    
    }