<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        //getting all users where id is not equal to current user
        $users=User::where('id','!=',auth()->user()->id)->get();
        //getting all tasks sorted by 'createdAt' property
        $tasks = Task::all()->sortBy("createdAt");
        $nastavnici = array();
        foreach($tasks as $task){
            //gettning professors data for each task (because only id is stored in each task)
            array_push($nastavnici, User::where('id', $task->nastavnik)->get());
        }
       
        return view('home', ['users'=>$users, 'tasks'=> $tasks, 'professors'=>$nastavnici]);
    }
}
