<?php

    const PATH_ROOT = __DIR__ . '/';

    if (!function_exists('asset')){
        function asset($path){
            return $_ENV['BASE_URL'] . $path;
        }
    }

    if (!function_exists('url')) {
        function url($uri = null) {
            return $_ENV['BASE_URL'] . $uri;
        }
    }

    if (!function_exists('auth_check')) {
        function auth_check() {
            // Nếu mà check thành công isset user thì sẽ chuyển hướng về trang admin
            // còn không thì sẽ bỏ qua, thực hiện đi tiếp để login
            if(isset($_SESSION['user'])){
                header('Location: ' . url('admin/'));
                exit;
            }
        }
    }