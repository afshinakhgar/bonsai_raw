@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-person"></i>
            <h3 class="box-title">کاربر ها</h3>
            <div class="box-tools pull-left">
                <ul class="pagination pagination-sm inline">
                    @include('admin.includes.widgets.paging',[
                    'pagination'=>$pagination
                    ])
                </ul>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if(isset($list))

            <ul class="todo-list">
                    @foreach($list as $user)
                <li>
                    <!-- drag handle -->

                    <!-- checkbox -->
                    <input type="checkbox" value="" name="">
                    <!-- todo text -->
                    <span class="text">

                        <a href="{{route('admin.user.profile',['username'=>$user->username])}}">

                            <span class="profile_image_list">
                                @include('admin.includes.widgets.profile_photo',['type'=>'user_profile','size'=>'thumb'])
                            </span>

                            {{$user->first_name}} /  {{$user->last_name}}
                        </a>
                    </span>
                    <span class="text"> {{$user->mobile}} |  {{$user->username}}</span>
                    <!-- Emphasis label -->
                    @foreach($user->roles as $role)

                    <small class="label label-info">
                           {{$role->display_name}}
                    </small>
                @endforeach

                <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <a href="{{route('admin.user.edit',['id'=>$user->id])}}" class="fa fa-edit"></a>
                        <a href="{{route('admin.user.delete',['id'=>$user->id])}}" class="fa fa-trash"></a>
                    </div>
                </li>

                @endforeach
            </ul>
            @endif
        </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <a href="{{route('admin.user.create')}}" class="btn btn-default pull-left"><i class="fa fa-plus"></i> اضافه کردن کاربر</a>
        </div>
    </div>


@endsection