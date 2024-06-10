<?php
    namespace Lenovo\Shop\Controllers\Client;

    use Lenovo\Shop\Commons\Controller;
    use Lenovo\Shop\Models\Product;

    class ProductController extends Controller{
        private Product $product;

        public function __construct()
        {
            $this->product = new Product();
        }

        public function index(){
            
        }

        public function detail($id){
            $product = $this->product->findByID($id);

            $this->renderViewClient('product-detail', [
                'product' => $product
            ]);
        }
    }