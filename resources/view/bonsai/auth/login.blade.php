@extends('layout/main')

@section('content')

	<div class="container">
		<br>
		<h1 class="well">{{trans('auth.register.registration_form_title')}}</h1>
		<div class="col-lg-12 well">
			<div class="row">
				<form action="{{route('auth.login')}}" method="POST">
					<div class="col-sm-12">


						<div class="row">

							<div class="col-sm-6 form-group">
								<label>{{trans('auth.register.username')}}</label>
								<input name="loginfield" type="text" placeholder="{{trans('auth.register.username')}}" class="form-control">
							</div>

							<div class="col-sm-6 form-group">
								<label>{{trans('auth.register.password')}}</label>
								<input name="password" type="password" placeholder="{{trans('auth.register.password')}}" class="form-control">
							</div>


						</div>

						<input type="submit" class="btn btn-lg btn-info" value="{{trans('auth.register.submit')}}">
					</div>
				</form>
			</div>
		</div>
	</div>


@endsection
