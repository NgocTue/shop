<?php
    // $router->get('/admin', function(){
    //     echo "Trang chủ Admin";
    // });

    // CRUD bao gồm : Danh sách, Thêm , Sửa, Xóa, Xem
    // User:
    // GET    -> USER/INDEX   -> INDEX  -> Danh sách
    // GET    -> USER/CREATE  -> CREATE -> Hiển thị FORM thêm mới
    // POST   -> USER/STORE   -> STORE  -> Lưu trữ dữ liệu từ FORM thêm mới vào DB
    // GET    -> USER/ID      -> SHOW {$id}   -> Xem chi tiết
    // GET    -> USER/ID/EDIT -> EDIT {$id}   -> Hiển thị FORM cập nhật
    // PUT    -> USER/ID      -> UPDATE {$id} -> Lưu dữ liệu từ FORM cập nhật vào DB
    // DELETE -> USER/ID      -> DELETE {$id} -> Xóa bản ghi trong DB

use Lenovo\Shop\Controllers\Admin\CategoryController;
use Lenovo\Shop\Controllers\Admin\DashboardController;
use Lenovo\Shop\Controllers\Admin\ProductController;
use Lenovo\Shop\Controllers\Admin\UserController;

    $router->before('GET|POST', '/admin/*.*', function() {
        // Kiểm tra nếu mà chưa thực hiện login lưu thông tin thì lập tức sẽ chuyển lại về trang login
        if (!isset($_SESSION['user'])) {
            header('location: ' . url('login'));
            exit();
        }
    });

    // CRUD USER
    $router->mount('/admin', function () use ($router){

        $router->get('/',                    DashboardController::class . '@dashboard');

        $router->mount('/users', function () use ($router){
            $router->get('/',                 UserController::class . '@index');  // Danh sách
            $router->get('/create',           UserController::class . '@create'); // Thêm mới
            $router->post('/store',           UserController::class . '@store');  // Lưu vào db
            $router->get('/{id}/show',        UserController::class . '@show');   // Xem chi tiết
            $router->get('/{id}/edit',        UserController::class . '@edit');   // Show form sửa
            $router->post('/{id}/update',     UserController::class . '@update'); // Cập nhật
            $router->get('/{id}/delete',      UserController::class . '@delete'); // Xóa
        });

        $router->mount('/products', function () use ($router){
            $router->get('/',                 ProductController::class . '@index');
            $router->get('/create',           ProductController::class . '@create');
            $router->post('/store',           ProductController::class . '@store');
            $router->get('/{id}/show',        ProductController::class . '@show');
            $router->get('/{id}/edit',        ProductController::class . '@edit');
            $router->post('/{id}/update',     ProductController::class . '@update');
            $router->get('/{id}/delete',      ProductController::class . '@delete');
            $router->get('/admin/products/stats', ProductController::class . '@stats');

        });

        $router->mount('/categories', function () use ($router){
            $router->get('/',                 CategoryController::class . '@index');
            $router->get('/create',           CategoryController::class . '@create');
            $router->post('/store',           CategoryController::class . '@store');
            $router->get('/{id}/show',        CategoryController::class . '@show');
            $router->get('/{id}/edit',        CategoryController::class . '@edit');
            $router->post('/{id}/update',     CategoryController::class . '@update');
            $router->get('/{id}/delete',      CategoryController::class . '@delete');
        });
    });
        // $router->get('/admin/users',            UserController::class . '@index');
        // $router->get('/admin/users/create',     UserController::class . '@create');
        // $router->post('/admin/users/store',     UserController::class . '@store');
        // $router->get('/admin/users/{$id}',      UserController::class . '@show');
        // $router->get('/admin/users/{$id}/edit', UserController::class . '@edit');
        // $router->put('/admin/users/{$id}',      UserController::class . '@update');
        // $router->delete('/admin/users/{$id}',   UserController::class . '@delete');
