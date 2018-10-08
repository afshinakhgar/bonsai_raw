@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-person"></i>
            <h3 class="box-title">{{$user->first_name}} {{$user->last_name}} </h3>
            <div class="box-tools pull-left">
                <a href="{{route('admin.user.edit',['id'=>$user->id])}}">[{{$user->username}}]</a>
            </div>
        </div><!-- /.box-header -->

    </div>


    {{--Attends Users--}}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"> <i class="fas fa-archive"></i>   شرکت در بسته ({{$user->attendStudy->count()}} بسته)</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <ul>
                @foreach($user->attendStudy as $study)
                    <li>
                        <a href="{{route('admin.study.edit',['id'=>$study->id])}}">
                            {{$study->title}}

                            <div class="label label-info">
                                تاریخ شرکت
                                {{jalaliDate('Y/m/d',strtotime( $study->pivot->created_at),$none='',$time_zone='Asia/Tehran',$tr_num='fa')}}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

    </div>



    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"> <i class="fas fa-archive"></i>   شرکت  در  ({{$user->attendExam->count()}} آزمون)</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <ul>
                @foreach($user->attendExam as $row)
                    <li>
                        <a href="{{route('admin.study.exam.edit',['id'=>$row->id])}}">
                            {{$row->title}}
                            <div class="label label-info">
                                تاریخ شرکت
                                {{jalaliDate('Y/m/d',strtotime( $row->pivot->created_at),$none='',$time_zone='Asia/Tehran',$tr_num='fa')}}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

    </div>

  <div class="box-footer clearfix no-border">
        <a href="{{route('admin.user.create')}}" class="btn btn-default pull-left"><i class="fa fa-plus"></i> اضافه کردن کاربر</a>
    </div>

</div>


@endsection