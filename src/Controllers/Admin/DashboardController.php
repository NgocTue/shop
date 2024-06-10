<?php
    namespace Lenovo\Shop\Controllers\Admin;

    use Lenovo\Shop\Commons\Controller;
    use Lenovo\Shop\Models\Product;

    class DashboardController extends Controller{
        private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function dashboard() {    
        $products = $this->product->all();

        $analysisProduct = array_map(function ($item) {
            
            $name = $item['name'] ?? 'Không xác định';
            $views = $item['views'] ?? 0;
               return [
                $name,
                $views
            ];
        }, $products);

        array_unshift($analysisProduct, ['Tên sản phẩm', 'Lượt views']);

        $this->renderViewAdmin(__FUNCTION__, [
            'analysisProduct' => $analysisProduct
        ]);
    }

    // public function dashboard() {    
    //     $products = $this->product->all();
    
    //     // In ra mảng $products để kiểm tra cấu trúc của nó
    //     // echo '<pre>';
    //     // print_r($products);
    //     // echo '</pre>';
    
    //     $analysisProduct = array_map(function ($item) {
    //         // Kiểm tra xem có tồn tại các khóa 'name' và 'views' không
    //         $name = $item['name'] ?? 'Không xác định';
    //         $views = $item['views'] ?? 0;
    
    //         return [
    //             $name,
    //             $views
    //         ];
    //     }, $products);
    
    //     array_unshift($analysisProduct, ['Tên sản phẩm', 'Lượt views']);
    
    //     $this->renderViewAdmin(__FUNCTION__, [
    //         'analysisProduct' => $analysisProduct
    //     ]);
    // }
}