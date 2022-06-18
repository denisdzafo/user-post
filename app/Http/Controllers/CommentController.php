<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repository\CommentRepository;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    private $commentRepostitory;

    public function __construct(CommentRepository $commentRepostitory)
    {
        $this->commentRepostitory = $commentRepostitory;
    }

    public function createComment(CreateCommentRequest $request)
    {
        if($this->processCreateComment($request))
            return response()->json(['status' => 'success'], 200);

        return response()->json(['status' => 'error'], 502);   
    }

    private function processCreateComment($request)
    {
        $data = json_decode($request->getContent(), true);
        $comment = $data['comment'];
        $postId = $data['post_id'];
        $userId = $data['user_id'];


        if($this->commentRepostitory->createComment($comment, $postId, $userId))
            return true;
    
        return false;   
    }
}
