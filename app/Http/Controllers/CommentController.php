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

    //Dependency Injection za CommentRepository, ovo se uvijek u konstruktoru radi
    public function __construct(CommentRepository $commentRepository)
    {
        //na ovaj nacin mozemo iz svake funkcije pristupiti svim metodama iz CommentRepository
        $this->commentRepository = $commentRepository;
    }

    //Ubacimo CheckCommentRequest validaciju koja gleda da li su svi potrebni inputi iz FORME poslati
    public function create(CheckCommentRequest $request) {
        $user = Auth::user(); // Fetchamo USERA is Fasade Auth, tako komanda radi ne pitaj me xd
        $data = $request->all(); // U varijablu $data sacuvam sve podatke iz FORME
        $data['user_id'] = $user->id; // Uzmemo USER id i dodamo ga u podatke iz $data
        $this->commentRepository->comment($data); // Posaljem sve podatke u REPOSITORY koji razogvara sa databazom
        $request->session()->flash('status', 'Successfully commented'); // ovo sam mores skontat
        return back();
    }
}
