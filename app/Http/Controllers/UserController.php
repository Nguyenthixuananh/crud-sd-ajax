<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        if (Auth::check()) {
            $users = $this->userRepository->getAll();
            return view('user.list', compact('users'));
        }else return redirect()->route('admin.login');
    }

    public function showAllNote($id)
    {
        $notes = $this->userRepository->getNotesById($id);
        return view("user.showNoteOfUser", compact("notes"));
    }
}
