@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">

        <div class="box-body">
            <form method="post" enctype="multipart/form-data"  action="{{route('admin.role.update',['id'=>$role->id])}}" id="#" class="col-md-12 go-right">
                <div class="form-group">
                    <label for="name">نام نقش</label>
                    <input id="name" name="name" type="text" class="form-control"  value="{{$role->name}}">
                </div>
                <div class="form-group">
                    <label for="name">عنوان نقش </label>
                    <input id="display_name" name="display_name" type="text" class="form-control" value="{{$role->display_name}}">
                </div>

                <div class="form-group ">
                    <input type="submit" value="ارسال" class="form-control btn btn-success" >
                </div>
            </form>
        </div>


    </div>

    <div class="box box-primary">

        <div class="box-body">
            <h5>دسترسی ها</h5>
            <form method="post" enctype="multipart/form-data"  action="{{route('admin.role.attach_perms',['id'=>$role->id])}}" id="#" class="col-md-12 go-right">

            <ul>
                <li>
                    <input type="checkbox"  id="checkAll"> انتخاب همه
                    <hr>
                </li>
               @foreach($all_perms as $perm)
               <li>
                   <input type="checkbox" name="perm[{{$perm->id}}]" {{$selected_perms[$perm->id] ? 'checked ' :  ''}}>
                   {{$perm->display_name}}
               </li>
               @endforeach
           </ul>

                <div class="form-group ">
                    <input type="submit" value="انتخاب دسترسی" class="form-control btn btn-success" >
                </div>
            </form>

        </div>

        <script>
            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>


    </div>

    @include('admin.includes.js.roles')

@endsection