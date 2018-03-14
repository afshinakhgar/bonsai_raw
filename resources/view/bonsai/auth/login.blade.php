@extends('layout/main')

@section('content')

    <div class="container " >
        <h1>ورود به کافه</h1>
        <form action="{{route('login.step1')}}" method="post">
            <div class="form-group">
                <input name="login"  type="text" class="form-control" id="login" placeholder="شماره تلفن همراه">
            </div>

            <div class="form-group">
                <label for="login">رمز عبور</label>
                <input  name="password"  type="password" class="form-control" id="mobile" placeholder="رمز عبور">
            </div>

            <input type="submit" value="ورود" class="btn btn-success">
        </form>
    </div>

@endsection