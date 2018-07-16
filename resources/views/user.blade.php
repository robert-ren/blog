@extends('layouts.app')
@section('content')
    <div class="container">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{route('userList')}}">{{  __('User List')}}</a>
            <a class="breadcrumb-item active"
               href="{{route('profile',$user->id)}}">{{$user->first_name.' '.$user->last_name}}</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">{{ __('Update User') }}</div>
                    <form method="get">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <div class="card-body">
                        @if (session('user_success'))
                            <div class="alert alert-success">
                                {{ session('user_success') }}
                            </div>
                        @endif
                        <form action="{{route('userUpdate',$user->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Title') }}
                                    :</label>
                                <div class="col-md-6">
                                    <select id="title" class="form-control" name="title">
                                        <option value="Mr" {{$user->title =='Mr'?'selected':''}}>{{ __('Mr') }}</option>
                                        <option value="Ms" {{$user->title =='Ms'?'selected':''}}>{{ __('Ms') }}</option>
                                        <option value="Dr" {{$user->title =='Dr'?'selected':''}}>{{ __('Dr') }}</option>
                                        <option value="Miss" {{$user->title =='Miss'?'selected':''}}>{{ __('Miss') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('First Name') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           name="first_name" value="{{$user->first_name}}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Last Name') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           name="last_name" value="{{$user->last_name}}" required autofocus>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Email') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{$user->email}}" type="email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Gender') }}:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="gender" type="radio" id="gender_male"
                                           value="1" {{ $user->gender? 'checked':''}} >
                                    <label class="form-check-label" for="gender_male">{{ __('Male') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="gender" type="radio" id="gender_female"
                                           value="0" {{ $user->gender? '':'checked'}}>
                                    <label class="form-check-label" for="gender_female">{{ __('Female') }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Status') }}:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="activate" type="radio" id="activate"
                                           value="1" {{ $user->activate?'checked':''}}>
                                    <label class="form-check-label" for="activate">{{ __('Active') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="activate" type="radio" id="inactivate"
                                           value="0" {{ $user->activate? '':'checked'}}>
                                    <label class="form-check-label" for="inactivate">{{ __('Inactive') }}</label>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">{{ __('Update Password') }}</div>
                    <form method="get">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <div class="card-body">
                        @if (session('password_success'))
                            <div class="alert alert-success">
                                {{ session('password_success') }}
                            </div>
                        @endif
                        <form action="{{route('passwordUpdate',$user->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Old Password') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                           name="old_password" type="password" required>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('New Password') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" type="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">{{ __('Re-type New Password') }}
                                    :</label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" type="password" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection