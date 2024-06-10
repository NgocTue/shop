<?php
    namespace Lenovo\Shop\Controllers\Client;

    use Lenovo\Shop\Commons\Controller;
    use Lenovo\Shop\Models\Product;

    class HomeController extends Controller{
        private Product $product;

        public function __construct()
        {
            $this->product = new Product();
        }

        public function index(){
            $name = 'NgocTue Nguyen';

            $products = $this->product->all();

            $this->renderViewClient('home', [
                'name' => $name,
                'products' => $products
            ]);
        }
    }