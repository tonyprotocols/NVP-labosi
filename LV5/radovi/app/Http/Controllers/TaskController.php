<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    //setting auth middleware to all routes controlled by task controller
    public function __construct(){
        $this->middleware('auth');
    }
    //setting locale(english or croatian) based on value that is stored in db, and returning view for creating new tasks
    function create(){
        App::setLocale(auth()->user()->locale);
        return view('tasks.create');
    }
    //setting new locale('en' or 'hr') and storing it in db
    function setLocale($locale){
        $user = User::find(auth()->user()->id);
        $user->locale = $locale;
        $user->save();
        return back();
    }
    //saving task to database with data from form
    function save(Request $request){
        $task = new Task();
        $task->naziv_rada = $request->naziv_rada;
        $task->naziv_rada_en = $request->naziv_rada_en;
        $task->zadatak_rada = $request->zadatak_rada;
        $task->tip_studija = $request->type;
        $task->nastavnik = auth()->user()->id;
        $task->save();
        return redirect('/home');
    }
    //function that handles request to apply for task, if user is already applied then he will get proper alert message
    function applyForTask($id){
        $task = Task::find($id);
        $students = array();
        foreach($task->studenti as $id){
            if($id == auth()->user()->id) return redirect()->back()->with('jsAlert', 'You have already applied for this task');
            $students[] = $id;
        }
        $students[] = auth()->user()->id;
        $task->studenti = $students;
        $task->save();
        return redirect()->back()->with('jsAlert', 'You have successfully applied');
    }
    // getting all applications(if there are none for task then it will not be fetched) with students that applied
    function getApplications(){
        $tasks = Task::where('nastavnik', auth()->user()->id)->whereJsonLength('studenti','!=', 0)->get();
        $students = array();
        foreach($tasks as $task){
            foreach($task->studenti as $studentId){
                $student = User::find($studentId);
                $students[] = $student;
            }
        }
        return view('tasks.applications', ['tasks'=>$tasks, 'students'=>$students]);
    }
    //saving selected user id for single task(there can be only one selected student)
    function selectStudent($taskId, $studentId){
        $task = Task::find($taskId);
        $task->izabrani_student = $studentId;
        $task->save();
        return redirect('/task/application');
    }
}
