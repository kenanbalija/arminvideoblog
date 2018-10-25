<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckPostRequest;
use Illuminate\Http\Request; // OVAJ ti i ne treba jer koristimo svoje CUSTOM requeste
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
    // Dependency Injection (DI) postRepository u ovaj kontroler kako bismo lakse pristupili podacima, ovo se uvijek u konstruktoru radi
    public function __construct(PostRepository $postRepository)
    {
        //na ovaj nacin mozemo iz svake funkcije pristupiti svim metodama iz PostRepository
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

    //Validacija Requesta za poslane inpute iz forme
    public function create(CheckPostRequest $request) {
        $user = Auth::user(); // Fetchamo usera
        $data = $request->all(); // Uzmemo sve inpute iz forme
        $data['user_id'] = $user->id; // Dodamo novi podatak u varijablu

        $file = $request->file('file'); // Uzmemo file
        $data['video'] = $this->saveFile($file); //save file zapravo sacuva file i vrati nam IME tog filea koji sacuva u varijablu $data

        $this->postRepository->create($data); // posaljemo sve podatke iz $data varijable u repository

        $request->session()->flash('status', 'Post created'); // bacimo status u view
        return back();
    }

    public function posts() {
        $posts = $this->postRepository->getPosts(); // fetchamo sve POSTOVE iz databaze
        return view('pages.posts', compact('posts')); // ovo compact znaci da posaljemo te podatke u VIEW i mozes u VIEW-u pristupiti tome sa $posts
    }

    public function post($id) {
        $post = $this->postRepository->getPost($id); // Na ovaj nacin samo fetchamo 1 post iz databaze ciji je ID = $id
        $commentData = $post->comments; // ovo jeono sto sam ti pricao, imamo Post model u kojem je napisana funkcija comments(), tj laksi nacin da se fetchaju svi komentari vezani za ovaj post
        $comments = $this->transformCommentData($commentData); // ovo samo transformisemo podatke
        return view('pages.post', compact('post', 'comments')); // proslijedimo u view 2 varijble, $post i $comments
    }

    private function saveFile($file) {
        $filename = $file->getClientOriginalName();  // ovo je php funkcija kojom dobijes orginalno ime file-a
        $ext = pathinfo($filename, PATHINFO_EXTENSION); // php funkcija kojom dobijes EKSTENZIJU file-a
        $hashed = md5($filename . microtime()) . '.' . $ext; // hashujem IME filea (microtime je php funkcija za vrijeme ja mislim) i dodamo mu ekstenziju
        $path = public_path().'/uploads/'; // public/uploads => path gdje cemo sacuvati file
        $file->move($path, $hashed); // i metoda koja cuva file u path koji smo definisali
        return $hashed; // vrati ime kodirano ime file-a
    }

    private function transformCommentData($comments) {
        $data = []; // array
        foreach ($comments as $comment) {
            // ovo je for loop, mogo si napisati for ($i =0; $< count($comment); $i++) { ... }
            array_push($data, [
                // pushas podatke u $daata array
                'value' => $comment->value, // ovo ti je ko objekat u js-u, samo sto se ovdje zove "key-value pair array"
                'user' => $comment->user->name
            ]);
        }
        return $data; // na kraju vratis array
    }



}
