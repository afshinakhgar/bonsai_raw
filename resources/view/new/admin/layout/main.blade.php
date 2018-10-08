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



            @include('includes.messages')

            @yield('content')
        </section>
    </div>

@include('admin.includes.footer')

@include('admin.includes.foot')

</body>


</html>