@extends('admin.layout.main')

@section('content')
    <div class="box box-primary">

        <div class="box-body">
            <form method="post" enctype="multipart/form-data"  action="{{route('admin.user.update',['id'=>$user->id])}}" id="#" class="col-md-12 go-right">
                <div class="form-group">
                    <label for="name">نام</label>
                    <input id="first_name" name="first_name" type="text" class="form-control"  value="{{$user->first_name}}">
                </div>
                <div class="form-group">
                    <label for="name">نام خانوادگی</label>
                    <input id="last_name" name="last_name" type="text" class="form-control" value="{{$user->last_name}}">
                </div>
                <div class="form-group">
                    <label for="mobile">شماره تلفن</label>

                    <input id="mobile" name="mobile" type="tel" class="form-control" required value="{{$user->mobile}}">
                </div>

                <div class="form-group">
                    <label for="mobile">نام کاربری *</label>

                    <input id="mobile" name="username" type="text" class="form-control" required value="{{$user->username}}">
                </div>


                <div class="form-group">
                    <label for="mobile">ایمیل</label>

                    <input id="email" name="email" type="email" class="form-control" required value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="mobile">نقش</label>

                    <span id="current_demo_roles">
                        @foreach($user->roles as $role)
                            <span class="remove_role badge badge-warning" data-id="{{$role->id}}" style="margin-right:5px;direction: ltr;cursor: pointer;">
                            {{$role->display_name}} <i  class="danger">[x]</i>
                            </span>



                            <script>
                                var role = [];

                                role.push({{$role->id}});
                            </script>
                        @endforeach


                        <?php
                            $rdata = [];
                            $data_roles = [];
                            foreach ($user->roles as $r){
                                $rdata[$r->id] = $r->display_name;
                                $data_roles[$r->id] = $r->id;
                            }

                            foreach ($roles as $id=>$rs){
                                $r_data_2[$id] = $rs;
                            }
                            $role_diff = array_diff((array)$r_data_2,(array)$rdata);
//                            $role_diff = $r_data_2;
                            ?>
                    </span>

                    <select  id="roles"  class="form-control">

                        @foreach($role_diff as $key=>$role)
                            <option id="role_item_{{$key}}" value="{{$key}}">
                                {{$role}}
                            </option>
                        @endforeach
                            <option value="0">
                                -----------
                            </option>
                    </select>
                    <div id="add_role" class="btn btn-info" style="margin-top: 10px"> + </div>
                    <input type="hidden" name="roles" value="{{implode(',',$data_roles)}}" id="current_roles">
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