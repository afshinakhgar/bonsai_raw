<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.includes.head')

</head>
<body class="skin-blue sidebar-mini sidebar-open">
<div class="wrapper">
@include('admin.includes.header')
@include('admin.includes.aside')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            @include('includes.messages')

            @yield('content')
        </section>
    </div>
</div>

@include('admin.includes.footer')

@include('admin.includes.foot')

</body>


</html>