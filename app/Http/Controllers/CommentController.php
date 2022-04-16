<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store($post)
    {
        //some logic to store data in db
        $data = request()->all();
        //insert into database
        Comment::create(
            [
                'comment' => $data['comment'],
                'post_id' => $post,
            ]
        );
        return to_route('posts.show', ['post' => $post]);
    }
}
