<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\CommentRepository;
use App\Http\Requests\CheckCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentController constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create(CheckCommentRequest $request) {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $this->commentRepository->comment($data);
        $request->session()->flash('status', 'Successfully commented');
        return back();
    }
}
