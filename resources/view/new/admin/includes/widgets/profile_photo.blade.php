<?php
$photoUrl = public_path('uploads/'.getImageDirName($user->id,$type).getImageFileName($user->id,$size,$type)).'.jpg';
?>

    @if($user->has_pic == 'yes')
        <img class="card-img-top" src="{{$photoUrl}}">
    @else
        @if($user->email)
            <img class="card-img-top" src="{{get_gravatar($user->email)}}">
        @else
            <img class="card-img-top" src="{{asset('templates/cafe/img/avatar.png?1')}}">
        @endif
    @endif


