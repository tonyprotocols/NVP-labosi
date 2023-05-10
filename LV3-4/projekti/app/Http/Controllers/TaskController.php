<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
  /**
   * The task repository instance.
   *
   * @var TaskRepository
   */
  protected $tasks;

  /**
   * Create a new controller instance.
   *
   * @param  TaskRepository  $tasks
   * @return void
   */
  public function __construct(TaskRepository $tasks)
  {
      $this->middleware('auth');

      $this->tasks = $tasks;
  }

  /**
   * Display a list of all of the user's task.
   *
   * @param  Request  $request
   * @return Response
   */
//   public function index(Request $request)
//   {
//         $user = auth()->user();
//         return view('tasks.index', [
//           'tasks' => $this->tasks->forUser($request->user()),
//           'user' => $user,

//       ]);

//   }
    public function index(Request $request)
    {
        $user = auth()->user();
        $tasks = $this->tasks->forUser($user);
        $memberTasks = $this->tasks->forMember($user->name);

        return view('tasks.index', [
            'tasks' => $tasks->merge($memberTasks),
            'user' => $user,
            'name' => $user->name,
        ]);
    }

  /**
   * Create a new task.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $customMessages = [
        'max' => 'Atribut je maksimalno 255 nakova'
      ];
      $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required|max:255',
          'price' => 'required|max:255',
          'jobs' => 'required|max:255',
          'start_date' => 'required|max:255',
          'end_date' => 'required|max:255',
          'members' => 'required|max:255',
      ],$customMessages);

      $request->user()->tasks()->create([
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price,
          'jobs' => $request->jobs,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'members' => $request->members,
      ]);

      return redirect('/tasks');
  }

  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */
  public function destroy(Request $request, Task $task)
  {
      $this->authorize('destroy', $task);

      $task->delete();

      return redirect('/tasks');
  }

  public function edit(Task $task)
  {
      $this->authorize('checkTaskOwner', $task);
      return view('tasks.edit', [
          'task' => $task,
      ]);
  }

  public function editMember(Task $task)
  {
      return view('tasks.editMember', [
          'task' => $task,
      ]);
  }

  /**
   * Update the current task
   *
   * @param Request $request
   * @param Task $task
   * @return type
   */
//   public function update(Request $request, Task $task)
//   {
//       $this->authorize('checkTaskOwner', $task);
//       $task->update($request->all());
//       return redirect('/tasks');
//   }

  public function update(Request $request, Task $task)
  {

    // if ($this->authorize('checkIsMember', $task)) {
    //     $task->update($request->all());
    // }
    if (Gate::allows('checkTaskOwner', $task) || Gate::allows('checkIsMember', $task)) {
        $task->update($request->all());
    }

    return redirect('/tasks');
  }
}
