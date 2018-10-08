<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.includes.head')

</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.includes.header')
    @include('admin.includes.aside')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">



    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                پیشخوان
                <small>پنل مدیریت</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">پیشخوان</li>
            </ol>
        </section>



        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$GLOBALS['views']['total_Studdies']}}</h3>
                            <p>دوره در مجموعه </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-grid"></i>
                        </div>
                        <a href="{{route('admin.study.list')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue-gradient">
                        <div class="inner">
                            <h3>{{(int)$GLOBALS['views']['total_lessons']}}</h3>
                            <p>تعداد کل دروس</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('admin.study.lesson.list')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$GLOBALS['views']['total_exams']}}<sup style="font-size: 20px"></sup></h3>
                            <p>تعداد آزمون </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.study.exam.list')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{(int)$GLOBALS['views']['total_registered_users']}}</h3>
                            <p>کاربر ثبت نام کرده</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.user.list')}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            @include('includes.messages')

            @yield('content')
        </section>
    </div>

@include('admin.includes.footer')

@include('admin.includes.foot')

</body>


</html>