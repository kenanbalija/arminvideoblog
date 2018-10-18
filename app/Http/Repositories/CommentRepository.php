<?php


namespace App\Http\Repositories;

use App\Comment;

class CommentRepository
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * CommentRepository constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function comment($data) {
        $this->comment->user_id = $data['user_id'];
        $this->comment->post_id = $data['post_id'];
        $this->comment->value = $data['comment'];
        $this->comment->save();
    }
}