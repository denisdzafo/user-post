<?php

namespace App\Http\Repository;

use App\Models\Comment;

class CommentRepository 
{
    public function createComment($commentText, $postId, $userId)
    {
        $comment = new Comment();
        $comment->comment_text = $commentText;
        $comment->post_id = $postId;
        $comment->user_id = $userId;
        return $comment->save();
    }

}
