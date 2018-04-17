@extends('admin.layout.main')

@section('content')
    <div class="container">
            <div class="row">

                <table id="admin_user_list"  class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>first name</th>
                            <th>last name</th>
                            <th>created at</th>
                            <th>roles</th>
                            <th>mobile</th>
                            <th>username</th>
                            <th>email</th>
                        </tr>
                    </thead>

                    <tbody>

                    @if(isset($list))
                        @foreach($list as $user)
                            <tr>
                                <td> {{$user->first_name}}  </td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->created_at}}</td>
                                <td> @foreach($user->roles as $role)
                                        <i class="badge badge-warning">{{$role->display_name}}</i>
                                    @endforeach</td>
                                <td>{{$user->mobile}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                            </tr>

                        @endforeach
                    @endif
                    </tbody>

                </table>


            </div>
        </div>  
    </div>  

    <br>



    <script>
        $(document).ready(function() {
            $('#admin_user_list').DataTable({
                "ajax": "data/objects.txt",
                "columns": [
                    { "data": "name" },
                    { "data": "position" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]
            });
        } );



    </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    @include('admin.includes.widgets.data_table')
    
@endsection