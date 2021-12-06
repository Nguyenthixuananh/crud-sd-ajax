<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Request;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAll()
    {
        $users = User::all();
        return $users;
    }
//    public function create(Request $request)
//    {
//        $data = $request->only('name','role_id', 'email', 'password');
//        $data['password'] = Hash::make($request->password);
//        $user = User::query()->create($data);
////        dd($user);
//        return $user;
//    }

    public function getNotesById($id)
    {
        $notes = User::find($id)->notes;

        return $notes;
    }
}
