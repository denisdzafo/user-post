<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Http\Repository\PostRepository;

class PostController extends Controller
{
    private $postRepostitory;

    public function __construct(PostRepository $postRepostitory)
    {
        $this->postRepository = $postRepostitory;
    }

    public function getPosts()
    {
        $posts = $this->postRepository->getPosts();
        return response()->json(['data' => $posts], 200);
       
    }

    public function createPost(CreatePostRequest $request)
    {
        if($this->processCreatePost($request))
            return response()->json(['status' => 'success'], 200);

        return response()->json(['status' => 'error'], 502);   
    }

    public function editPost(EditPostRequest $request)
    {
        if($this->processEditPost($request))
            return response()->json(['status' => 'success'], 200);

        return response()->json(['status' => 'error'], 502);   
    }

    public function deletePost($id)
    {
        if($this->postRepository->deletePost($id))
            return response()->json(['status' => 'success'], 200);

        return response()->json(['status' => 'error'], 502);  
    }

    public function getSinglePost($id)
    {
        $post = $this->postRepository->getSinglePost($id);
        return response()->json(['data' => $post], 200);
    }

    private function processCreatePost($request)
    {
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $date = $data['date'];
        $userId = $data['user_id'];
        $description = $data['description'];

        if($this->postRepository->createPost($title, $date, $userId, $description))
            return true;
        
        return false;    
    }

    private function processEditPost($request)
    {
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $date = $data['date'];
        $description = $data['description'];
        $postId = $data['post_id'];

        if($this->postRepository->editPost($postId, $title, $date, $description))
            return true;
        
        return false;    
    }
}
