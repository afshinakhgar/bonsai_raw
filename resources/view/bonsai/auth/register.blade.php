@extends('layout/main')

@section('content')

    <div class="container">
        <br>
        <h1 class="well">{{trans('auth.register.registration_form_title')}}</h1>
        <div class="col-lg-12 well">
            <div class="row">
                <form action="{{route('auth.register')}}" method="POST">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.first_name')}}</label>
                                <input name="first_name" type="text" placeholder="{{trans('auth.register.first_name')}}" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.last_name')}}</label>
                                <input name="last_name" type="text" placeholder="{{trans('auth.register.last_name')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.password')}}</label>
                                <input name="password" type="password" placeholder="{{trans('auth.register.password')}}" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.repass')}}</label>
                                <input name="password" type="password" placeholder="{{trans('auth.register.repass')}}" class="form-control">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{trans('auth.register.mobile_number')}}</label>
                                <input name="mobile" type="text" placeholder="{{trans('auth.register.mobile_number')}}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.email')}}</label>
                                <input name="email" type="email" placeholder="{{trans('auth.register.email')}}" class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.username')}}</label>
                                <input name="username" type="text" placeholder="{{trans('auth.register.username')}}" class="form-control">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-lg btn-info" value="{{trans('auth.register.submit')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection