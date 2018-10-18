<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckPostRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('pages.create');
    }

    /**
     * @param CheckPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CheckPostRequest $request) {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;

        $file = $request->file('file');
        $data['video'] = $this->saveFile($file);

        $this->postRepository->create($data);

        $request->session()->flash('status', 'Post created');
        return back();
    }

    public function posts() {
        $posts = $this->postRepository->getPosts();
        return view('pages.posts', compact('posts'));
    }

    public function post($id) {
        $post = $this->postRepository->getPost($id);
        $comments = $post->comments;
        return view('pages.post', compact('post', 'comments'));
    }

    private function saveFile($file) {
        $filename = $file->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $hashed = md5($filename . microtime()) . '.' . $ext;
        $path = public_path().'/uploads/';
        $file->move($path, $hashed);
        return $hashed;
    }



}
