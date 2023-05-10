@extends('layouts.app')

@section('content')
    @if (session()->has('jsAlert'))
        <script>
            const msg = '{{ Session::get('jsAlert') }}';
            const exist = '{{ Session::has('jsAlert') }}';
            if (exist) {
                alert(msg);
            }
        </script>
    @endif
    <div class="container">
        <div class="row justify-content-center h-100">
            <div class="col-md-10">
                <div class="card-header ">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (auth()->user()->role == 'admin')
                        <h2>Role: Admin</h2>
                    @elseif(auth()->user()->role == 'nastavnik')
                        <h2>Role: Nastavnik</h2>
                    @elseif(auth()->user()->role == 'student')
                        <h2>Role: Student</h2>
                    @else
                        <h2>Role: Guest</h2>
                    @endif
                </div>
                    @if (auth()->user()->role != 'nastavnik')
                        {{-- <div class="card"> --}}
                        @else
                            <div class="card">
                    @endif
                    @if (auth()->user()->role == 'admin')
                        @foreach ($users as $user)
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><b>User name:</b> {{ $user->name }}</p>
                                    <p class="card-text"><b>E-mail:</b> {{ $user->email }}</p>
                                    <p class="card-text"><b>Role:</b> {{ $user->role }}</p>
                                    <a href="/user/{{ $user->id }}"><button class="btn btn-info">Update</button></a>
                                </div>
                            </div>
                            <p></p>
                        @endforeach
                    @elseif(auth()->user()->role == 'student')
                        @foreach ($tasks as $index => $task)
                            @if (!$task->izabrani_student)
                            <div class="card">
                                <div class="card-body">
                                    <p><b>Task name:</b> {{ $task->naziv_rada }}</p>
                                    <p><b>Task name (English):</b> {{ $task->naziv_rada_en }}</p>
                                    <p><b>Details:</b> {{ $task->zadatak_rada }}</p>
                                    <p><b>Study type:</b> {{ $task->tip_studija }}</p>
                                    @foreach ($professors[$index] as $professor)
                                        <p><b>Professor</b> : {{ $professor->name }}</p>
                                    @endforeach
                                    <a href="/task/{{ $task->id }}"><button class="btn btn-success">Apply</button></a>
                                </div>
                            </div>
                            <p></p>
                            @endif
                        @endforeach
                    @endif


            </div>
        </div>

    </>
    </div>
@endsection
