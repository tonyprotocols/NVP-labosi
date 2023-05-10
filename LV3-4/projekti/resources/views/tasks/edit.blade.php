@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Uredi projekt
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Task Form -->
					<form action="{{url('task/' . $task->id)}}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
                                                {{ method_field('PATCH') }}

						<!-- Task Name -->
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label">Naziv projekta</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') ? old('task') : $task->name }}">
							</div>
						</div>

            	<!-- Task Description -->
						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Opis projekta</label>
							<div class="col-sm-6">
								<input type="text" name="description" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->description }}">
							</div>
						</div>

						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Cijena</label>
							<div class="col-sm-6">
								<input type="text" name="price" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->price }}">
							</div>
						</div>

						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Obavljeni poslovi</label>
							<div class="col-sm-6">
								<input type="text" name="jobs" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->jobs }}">
							</div>
						</div>

						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Datum pocetka</label>
							<div class="col-sm-6">
								<input type="text" name="start_date" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->start_date }}">
							</div>
						</div>

						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Datum zavrsetka</label>
							<div class="col-sm-6">
								<input type="text" name="end_date" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->end_date }}">
							</div>
						</div>

						<div class="form-group">
							<label for="task-description" class="col-sm-3 control-label">Clanovi</label>
							<div class="col-sm-6">
								<input type="text" name="members" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->members }}">
							</div>
						</div>

						<!-- Add Task Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-save"></i>Spremi
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
