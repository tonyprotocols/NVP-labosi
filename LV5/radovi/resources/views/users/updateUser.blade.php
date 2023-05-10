@extends('layouts.app')
@section('content')
    <div class="wrapper create-project">
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
        </div>
        <h1>Update user role</h1>
        {{-- form for Updating project and after pressing button, we are sending PUT request wih all data --}}
        <form action="/user" method="POST" id="create_project_form">
            @csrf
            @method('PUT')
            @if (auth()->user()->role == 'admin')
                <p><b>User:</b> {{ $user->name }}</p>
                <div class="row mb-3">
                    <div class="row-md-6" id="roles">
                        <input type="radio" id="role2" name="role" value="nastavnik">
                        <label for="age2">Nastavnik</label><br>
                        <input type="radio" id="role3" name="role" value="student" checked="checked">
                        <label for="age3">Student</label><br><br>
                    </div>
                    <input type="text" hidden name="id" value="{{ $user->id }}">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            @endif
        </form>
    </div>
@endsection
