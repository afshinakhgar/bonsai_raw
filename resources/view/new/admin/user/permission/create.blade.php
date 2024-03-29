@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">

        <div class="box-body">
            <form method="post" enctype="multipart/form-data"  action="{{route('admin.role.permission.store')}}" id="#" class="col-md-12 go-right">
                <div class="form-group">
                    <label for="name">نام دسترسی</label>
                    <input id="name" name="name" type="text" class="form-control"  value="">
                </div>
                <div class="form-group">
                    <label for="name">عنوان دسترسی </label>
                    <input id="display_name" name="display_name" type="text" class="form-control" value="">
                </div>

                <div class="form-group ">
                    <input type="submit" value="ارسال" class="form-control btn btn-success" >
                </div>
            </form>
        </div>


    </div>

    </div>
    @include('admin.includes.js.roles')

@endsection