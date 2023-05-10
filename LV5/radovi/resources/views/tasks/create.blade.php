@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('Create new thesis') }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('home') }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/task" method="POST" id="create_tasks">
        @csrf
        <div class="row col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                @if (App::getLocale() == 'en')
                    <div class="form-group">
                        <strong>{{ __('messages.taskNameEn') }}</strong>
                        <input type="text" name="naziv_rada_en" class="form-control">
                    </div>
                @elseif (App::getLocale() == 'hr')
                    <div class="form-group">
                        <strong>{{ __('messages.taskName') }}</strong>
                        <input type="text" name="naziv_rada" class="form-control">
                    </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('messages.details') }}</strong>
                    <textarea class="form-control" style="height:150px" name="zadatak_rada"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('messages.studyType') }}</strong>
                    <div id="study_type">
                        <input type="radio" id="type1" name="type" value="stručni">
                        <label for="type1">{{ __('messages.profStudProg') }}</label><br>
                        <input type="radio" id="type2" name="type" value="preddiplomski">
                        <label for="type2">{{ __('messages.undergraduate') }}</label><br>
                        <input type="radio" id="type3" name="type" value="diplomski" checked="checked">
                        <label for="type3">{{ __('messages.graduate') }}</label><br><br>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">{{ __('messages.create') }}</button>
            </div>
        </div>
    </form>
    @if (Config::get('app.locale') == 'en')
        <a href="/setLang/hr"><button class="btn btn-info">{{ __('messages.changeLangToCro') }}</button></a>
    @else
        <a href="/setLang/en"><button class="btn btn-info">{{ __('messages.changeLangToEng') }}</button></a>
    @endif
@endsection
