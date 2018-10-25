<?php
/*
 *
 * REPOSITORIJI NAM SLUZE KAKO BISMO KOMUNICIRALI SA DATABAZOM I KAKO BI SMO STO MANJE KODA PISALI U KONTROLERIMA
 *
 * */

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

    // Dependency Injection Modela Comment u konstruktor Klase CommentRepository kako bi lakse pristupio iz vise metoda tom file-u
    // sad npr ne moras inicijalizrati model u nekoj metodi, a to bi vako radio: "$model = new Comment" ili "$comment = new Comment"
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function comment($data) {
        // samo cuvas podatke komentara i sacuvas u db
        $this->comment->user_id = $data['user_id'];
        $this->comment->post_id = $data['post_id'];
        $this->comment->value = $data['comment'];
        $this->comment->save();
    }
}