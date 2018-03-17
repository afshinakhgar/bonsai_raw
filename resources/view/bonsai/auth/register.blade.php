@extends('layout/main')

@section('content')

    <div class="container">
        <br>
        <h1 class="well">{{trans('auth.register.registration_form_title')}}</h1>
        <div class="col-lg-12 well">
            <div class="row">
                <form action="register" method="post">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.first_name')}}</label>
                                <input type="text" placeholder="{{trans('auth.register.first_name')}}" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.last_name')}}</label>
                                <input type="text" placeholder="{{trans('auth.register.last_name')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{trans('auth.register.password')}}</label>
                                <input type="password" placeholder="{{trans('auth.register.password')}}" class="form-control">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.mobile_number')}}</label>
                                <input type="text" placeholder="{{trans('auth.register.mobile_number')}}" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{trans('auth.register.email')}}</label>
                                <input type="email" placeholder="{{trans('auth.register.email')}}" class="form-control">
                            </div>
                        </div>
                        <button type="button" class="btn btn-lg btn-info">{{trans('auth.register.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection