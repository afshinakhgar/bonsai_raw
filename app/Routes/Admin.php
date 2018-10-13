<?php
$roleMiddleWare = new App\Middleware\RoleMiddleWare( 'admin' );

$app->group('/admin', function () use ($app , $route) {

    $app->get('', \App\Controller\Admin\DashBoardController::class.':index')->setName('admin.dashboard.index');


    $app->group('/user', function () use ($app , $route) {
        $app->get('/list', \App\Controller\Admin\User\UserController::class.':index')->setName('admin.user.list');
        $app->get('/create', \App\Controller\Admin\User\UserController::class.':create')->setName('admin.user.create');
        $app->post('/store', \App\Controller\Admin\User\UserController::class.':store')->setName('admin.user.store');
        $app->get('/edit/{id}', \App\Controller\Admin\User\UserController::class.':edit')->setName('admin.user.edit');
        $app->post('/update/{id}', \App\Controller\Admin\User\UserController::class.':update')->setName('admin.user.update');
        $app->get('/delete/{id}', \App\Controller\Admin\User\UserController::class.':delete')->setName('admin.user.delete');
        $app->get('/profile/{username}', \App\Controller\Admin\User\UserController::class.':profile')->setName('admin.user.profile');
    });




    $app->group('/role', function () use ($app , $route) {
        $app->get('/list', \App\Controller\Admin\User\RoleController::class.':index')->setName('admin.role.list');
        $app->get('/create', \App\Controller\Admin\User\RoleController::class.':create')->setName('admin.role.create');
        $app->post('/store', \App\Controller\Admin\User\RoleController::class.':store')->setName('admin.role.store');
        $app->get('/edit/{id}', \App\Controller\Admin\User\RoleController::class.':edit')->setName('admin.role.edit');
        $app->post('/update/{id}', \App\Controller\Admin\User\RoleController::class.':update')->setName('admin.role.update');

        $app->post('/attach_perms/{id}', \App\Controller\Admin\User\RoleController::class.':attach_perms')->setName('admin.role.attach_perms');


        $app->group('/permission', function () use ($app , $route) {
            $app->get('/list', \App\Controller\Admin\User\PermissionController::class.':index')->setName('admin.role.permission.list');
            $app->get('/create', \App\Controller\Admin\User\PermissionController::class.':create')->setName('admin.role.permission.create');
            $app->post('/store', \App\Controller\Admin\User\PermissionController::class.':store')->setName('admin.role.permission.store');
            $app->get('/edit/{id}', \App\Controller\Admin\User\PermissionController::class.':edit')->setName('admin.role.permission.edit');
            $app->post('/update/{id}', \App\Controller\Admin\User\PermissionController::class.':update')->setName('admin.role.permission.update');
        });


    });

    $app->group('/search', function () use ($app , $route) {
        $app->get('/result', \App\Controller\Admin\SearchController::class.':search')->setName('admin.search.result');

    });



})->add($roleMiddleWare);
