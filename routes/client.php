<?php
    // $router->get('/', function(){
    //     echo "Trang chủ";
    // });

    // Website có các trang khác là:
    //     Trang chủ
    //     Giới thiệu
    //     Sản phẩm
    //     Chi tiết sản phẩm
    //     Liên hệ

    // Để định nghĩa được, điều kiện đầu tiên làm là phải tạo Controller trước
    // Tiếp theo, khao báo function tương ứng để xử lý
    // Bước cuối định nghĩa đường dẫn 

    // HTTP Method: GET, POST, PUT, (PATH), DELETE, OPTION, HEAD

    use Lenovo\Shop\Controllers\Client\AboutController;
    use Lenovo\Shop\Controllers\Client\CartController;
    use Lenovo\Shop\Controllers\Client\ContactController;
    use Lenovo\Shop\Controllers\Client\HomeController;
    use Lenovo\Shop\Controllers\Client\LoginController;
    use Lenovo\Shop\Controllers\Client\OrderController;
    use Lenovo\Shop\Controllers\Client\ProductController;

    $router->get('/',               HomeController::class    .    '@index');
    $router->get('/about',          AboutController::class   .    '@index');

    $router->get('/contact',        ContactController::class .    '@index');
    $router->post('/contact/store', ContactController::class .    '@store');

    $router->get('/products',       ProductController::class .    '@index');
    $router->get('/products/{id}',  ProductController::class .    '@detail');

    $router->get('/login',          LoginController::class .      '@showFormLogin');
    $router->post('/handle-login',  LoginController::class .      '@login');
    $router->get('/logout',         LoginController::class .      '@logout');

    $router->get('cart/add',            CartController::class .      '@add');
    $router->get('cart/quantityInc',    CartController::class .      '@quantityInc');
    $router->get('cart/quantityDec',    CartController::class .      '@quantityDec');
    $router->get('cart/remove',         CartController::class .      '@remove');
    $router->get('cart/detail',         CartController::class .      '@detail');
    $router->post('order/checkout',     OrderController::class .     '@checkout');

