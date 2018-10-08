@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-finger-print finger-print"></i>
            <h3 class="box-title">نقش ها</h3>
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
                    @foreach($list as $role)
                        <li>
                            <!-- drag handle -->

                            <!-- checkbox -->
                            <input type="checkbox" value="" name="">
                            <!-- todo text -->
                            <span class="text"> {{$role->display_name}} / = {{$role->name}} </span>
                            <!-- Emphasis label -->


                        <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <a href="{{route('admin.role.edit',['id'=>$role->id])}}" class="fa fa-edit"></a>
                                {{--<a href="{{route('admin.role.delete',['id'=>$role->id])}}" class="fa fa-trash-o"></a>--}}
                            </div>
                        </li>

                    @endforeach
                </ul>
            @endif
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix no-border">
        <a href="{{route('admin.role.create')}}" class="btn btn-default pull-left"><i class="fa fa-plus"></i> اضافه کردن نقش</a>
    </div>
    </div>


@endsection