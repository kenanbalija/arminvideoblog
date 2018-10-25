<?php
/*
 *
 * REPOSITORIJI NAM SLUZE KAKO BISMO KOMUNICIRALI SA DATABAZOM I KAKO BI SMO STO MANJE KODA PISALI U KONTROLERIMA
 *
 * */

namespace App\Http\Repositories;

use App\Post;

class PostRepository
{
    /**
     * @var Post
     */
    private $post;

    // Dependency Injection Modela Comment u konstruktor Klase PostRepository kako bi lakse pristupio iz vise metoda tom file-u
    // sad npr ne moras inicijalizrati model u nekoj metodi, a to bi vako radio: "$model = new Post" ili "$post = new Comment"
    public function __construct(Post $post)
    {
        // inicijaliziras model pri keriranju klase PostRepository
        $this->post = $post;
    }

    public function create($data)
    {
        $this->post['user_id'] = $data['user_id'];
        $this->post['title'] = $data['title'];
        $this->post['body'] = $data['body'];
        $this->post['video'] = $data['video'];
        $this->post->save();
    }

    public function getPosts()
    {
        return $this->post->get()->all();
    }

    public function getPost($id)
    {
        return $this->post->find($id);
    }
}