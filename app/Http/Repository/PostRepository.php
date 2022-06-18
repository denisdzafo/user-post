<?php

namespace App\Http\Repository;

use App\Models\Post;

class PostRepository 
{
    public function createPost($title, $date, $userId, $description)
    {
        $post = new Post();
        $post->title = $title;
        $post->date = $date;
        $post->user_id = $userId;
        $post->description = $description;

        return $post->save();
    }

    public function editPost($postId, $title, $date, $description)
    {
        $post = Post::find($postId);
        $post->title = $title;
        $post->date = $date;
        $post->description = $description;

        return $post->save();
    }

    public function deletePost($postId)
    {
        $post = Post::find($postId);
        return $post->delete();
    }

    public function getPosts()
    {
        return Post::with('comments')->with('user')->paginate(2);
    }

    public function getSinglePost($id)
    {
        return Post::with('comments')->with('user')->where('id', $id)->first();
    }
}
