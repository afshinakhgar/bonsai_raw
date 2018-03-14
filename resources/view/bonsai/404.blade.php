@extends('layout/main')

@section('content')
<div class="jumbotron">
    	{{trans('general.404')}}
</div>



<div class="container">
	<ul>
		<li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a><div class="text">facebook</div></li>
		<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a><div class="text">twitter</div></li>
		<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a><div class="text">google-plus</div></li>
		<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a><div class="text">linkedin</div></li>
		<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a><div class="text">skype</div></li>
	</ul>
</div>



@endsection