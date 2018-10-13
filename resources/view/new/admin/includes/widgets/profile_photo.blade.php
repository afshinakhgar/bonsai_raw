    <?php
    $photoUrl = public_path('uploads/'.getImageDirName($user->id,$type).getImageFileName($user->id,$size,$type)).'.jpg';
    ?>

    @if($user->has_pic == 'yes')
        <img class="img-profile thumbnail img-thumbnail image_profile_size_{{$size}}" src="{{$photoUrl}}">
    @else
        @if($user->email)
            <img class="img-profile thumbnail img-thumbnail image_profile_size_{{$size}}" src="{{get_gravatar($user->email)}}">
        @else
            <img class="img-profile thumbnail img-thumbnail image_profile_size_{{$size}}" src="{{asset('templates/cafe/img/avatar.png?1')}}" >
        @endif
    @endif


