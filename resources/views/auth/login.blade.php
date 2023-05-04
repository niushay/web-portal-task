@extends('auth.layout')

@section('title')
    Login - Portal
@endsection

@section('cover_image')
    {{url("assets/images/login-v2.svg")}}
@endsection

@section('content')
    <h2 class="card-title font-weight-bold mb-1">Welcome to Portal! 👋</h2>
    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
    <form class="auth-login-form mt-2" action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" id="username" type="text" name="username" value="365" aria-describedby="login-email" autofocus="" tabindex="1" />
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label for="login-password">Password</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input class="form-control form-control-merge" id="login-password" type="password" name="password" value="1" aria-describedby="login-password" tabindex="2" />
                <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
    </form>
@endsection

@section('page_js')
    <script src="{{url("assets/js/page-auth-login.js")}}"></script>
@endsection
