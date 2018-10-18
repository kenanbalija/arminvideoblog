<?php


namespace App\Http\Repositories;

use App\Post;

class PostRepository
{
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {

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