@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('home') }}">{{ __('Back') }}</a>
            </div>
            <div class="col-md-8">
                    @if (auth()->user()->role == 'nastavnik')
                        @foreach ($tasks as $index => $task)
                        <div class="card">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name (Croatian):</strong>
                                            {{ $task->naziv_rada }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            {{ $task->naziv_rada_en }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Details:</strong>
                                            {{ $task->zadatak_rada }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Type of study:</strong>
                                            {{ $task->tip_studija }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Selected student ID:</strong>
                                            {{ $task->izabrani_student }}
                                        </div>
                                    </div>
                                    <p></p>
                                    <h2>Students that are interested:</h2>
                                    @if (count($task->studenti) <= 1)
                                        <div class="card-body col-xs-12 col-sm-12 col-md-12">
                                            <p><b>Student:</b> {{ $students[0]->name }} <a href="/task/{{ $task->id }}/{{ $students[0]->id }}"><button class="btn btn-primary">Select</button></a></p>
                                            
                                        </div>
                                    @else
                                        @foreach ($students as $student)
                                                <div class="card-body col-xs-12 col-sm-12 col-md-12">
                                                    <p><b>Student name:</b> {{ $student->name }} <a href="/task/{{ $task->id }}/{{ $student->id }}"><button type="submit" class="btn btn-primary">Select</button></a></p>
                                                </div>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <p></p>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
@endsection
