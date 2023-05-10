<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //setting auth middleware to all routes controlled by user controller
    public function __construct(){
        $this->middleware('auth');
    }
    //fetching user by its id
    function getUserById($id){
        $user = User::find($id);
        return view('users.updateUser',['user'=> $user]);
    }
    //updating user role
    function update(Request $request){
        $user = User::find($request->id);
        $user->role = $request->role;
        $user->save();
        return redirect('/home');
    }
}
