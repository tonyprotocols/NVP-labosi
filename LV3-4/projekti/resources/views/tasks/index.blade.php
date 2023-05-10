@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dodaj novi projekt
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Naziv projekta</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>

                        </div>

                        <!-- Task Description -->
                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Opis</label>
                            <div class="col-sm-6">
                                <input type="text" name="description" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Task Description -->
                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Cijena</label>
                            <div class="col-sm-6">
                                <input type="text" name="price" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Task Description -->
                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Obavljeni poslovi</label>
                            <div class="col-sm-6">
                                <input type="text" name="jobs" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Datum pocetka</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_date" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Datum zavrsetka</label>
                            <div class="col-sm-6">
                                <input type="text" name="end_date" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Clanovi tima</label>
                            <div class="col-sm-6">
                                <input type="text" name="members" id="task-description" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        {{-- @if (count($users) > 0)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Registrirani korisnici:
                                </div>
                                @foreach ($users as $user)
                                    <p>{{ $user->name }}</p>
                                @endforeach
                            </div>
                        @endif --}}

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>Dodaj projekt
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Moji projekti
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Naziv projekta</th>
                                <th>Opis</th>
                                <th>Cijena</th>
                                <th>Obavljeni poslovi</th>
                                <th>Clanovi</th>
                                <th>Datum pocetka</th>
                                <th>Datum zavrsetka</th>
                                <th>Uredi</th>
                                <th>Obriši</th>
                            </thead>
                            <tbody>
                                {{-- @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->description }}</div></td>
                                        <td class="table-text"><div>{{ $task->price }}</div></td>
                                        <td class="table-text"><div>{{ $task->jobs }}</div></td>
                                        <td class="table-text"><div>{{ $task->members }}</div></td>
                                        <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                        <td class="table-text"><div>{{ $task->end_date }}</div></td>

                                        <td>
                                            <!-- Task Edit Button -->
                      											<form action="{{url('task/edit/' . $task->id)}}" method="GET" style="display: inline-block;">
                      												{{ csrf_field() }}
                      												<button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-success">
                      													<i class="fa fa-btn fa-edit"></i>Uredi
                      												</button>
                      											</form>
                                        </td>
                                         <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('task/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Obriši
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}

                                @foreach ($tasks as $task)
                                    @if ($task->user_id === $user->id)
                                        <tr>
                                            <td class="table-text"><div>{{ $task->name }}</div></td>
                                            <td class="table-text"><div>{{ $task->description }}</div></td>
                                            <td class="table-text"><div>{{ $task->price }}</div></td>
                                            <td class="table-text"><div>{{ $task->jobs }}</div></td>
                                            <td class="table-text"><div>{{ $task->members }}</div></td>
                                            <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                            <td class="table-text"><div>{{ $task->end_date }}</div></td>

                                            <td>
                                                <!-- Task Edit Button -->
                                                <form action="{{url('task/edit/' . $task->id)}}" method="GET" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-success">
                                                        <i class="fa fa-btn fa-edit"></i>Uredi
                                                    </button>
                                                </form>
                                            </td>
                                            <!-- Task Delete Button -->
                                            <td>
                                                <form action="{{url('task/' . $task->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Obriši
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="panel-heading">
                        Projekti na kojima sudjelujem
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Naziv projekta</th>
                                <th>Opis</th>
                                <th>Cijena</th>
                                <th>Obavljeni poslovi</th>
                                <th>Clanovi</th>
                                <th>Datum pocetka</th>
                                <th>Datum zavrsetka</th>
                                <th>Uredi</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @if (strpos($task->members, $user->name) !== false)
                                        <tr>
                                            <td class="table-text"><div>{{ $task->name }}</div></td>
                                            <td class="table-text"><div>{{ $task->description }}</div></td>
                                            <td class="table-text"><div>{{ $task->price }}</div></td>
                                            <td class="table-text"><div>{{ $task->jobs }}</div></td>
                                            <td class="table-text"><div>{{ $task->members }}</div></td>
                                            <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                            <td class="table-text"><div>{{ $task->end_date }}</div></td>

                                            <td>
                                                <!-- Task Edit Button -->
                                                <form action="{{url('task/editMember/' . $task->id)}}" method="GET" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-success">
                                                        <i class="fa fa-btn fa-edit"></i>Uredi kao član
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
