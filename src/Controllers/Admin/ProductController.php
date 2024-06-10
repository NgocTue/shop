<?php

namespace Lenovo\Shop\Controllers\Admin;

use Lenovo\Shop\Commons\Controller;
use Lenovo\Shop\Models\Category;
use Lenovo\Shop\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private Product $product;
    private Category $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        $products = $this->product->all();

        $this->renderViewAdmin('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = $this->category->all();

        $categoryPluck = array_column($categories, 'name', 'id');

        $this->renderViewAdmin('products.create', [
            'categoryPluck' => $categoryPluck
        ]);
    }

    // public function index()
    // {
    //     // $products = $this->product->paginate();

    //     [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

    //     $this->renderViewAdmin('products.index', [
    //         'products' => $products,
    //         'totalPage' => $totalPage
    //     ]);
    // }

    // public function create()
    // {
    //     $this->renderViewAdmin('products.create');
    // }

    public function store()
    {
        // VALIDATE
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'category_id'           => 'required',
            'name'                  => 'required|max:100',
            'overview'              => 'max:500',
            'content'               => 'max:65000',
            'price_regular'         => 'required',
            'img_thumbnail'         => 'uploaded_file:0,2048K,png,jpeg,jpg,webp',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/products/create'));
            exit;
        } else {
            $data = [
                'category_id'   => $_POST['category_id'],
                'name'          => $_POST['name'],
                'overview'      => $_POST['overview'],
                'content'       => $_POST['content'],
                'price_regular' => $_POST['price_regular'],
            ];

            if (!empty($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to   = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload KHÔNG thành công!';

                    header('Location: ' . url('admin/products/create'));
                    exit;
                }
            }

            $this->product->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url('admin/products'));
            exit;
        }
    }

    public function show($id)
    {
        $product = $this->product->findByID($id);

        $this->renderViewAdmin('products.show', [
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        $product = $this->product->findByID($id);
        $categories = $this->category->all();

        $categoryPluck = array_column($categories, 'name', 'id');

        $this->renderViewAdmin('products.edit', [
            'product' => $product,
            'categoryPluck' => $categoryPluck,
        ]);
    }

    // public function edit($id)
    // {
    //     $product = $this->product->findByID($id);
    //     $this->renderViewAdmin('products.edit', [
    //         'product' => $product
    //     ]);
    // }

    public function update($id)
    {
        $product = $this->product->findByID($id);

        // VALIDATE
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'category_id'           => 'required',
            'name'                  => 'required|max:100',
            'overview'              => 'max:500',
            'content'               => 'max:65000',
            'price_regular'         => 'required',
            'img_thumbnail'         => 'uploaded_file:0,2048K,png,jpeg,jpg,webp',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/products/$id/edit"));
            exit;
        } else {
            $data = [
                'category_id'   => $_POST['category_id'],
                'name'          => $_POST['name'],
                'overview'      => $_POST['overview'],
                'content'       => $_POST['content'],
                'price_regular' => $_POST['price_regular'],
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $flagUpload = true;

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to   = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload KHÔNG thành công!';

                    header('Location: ' . url("admin/products/$id/edit"));
                    exit;
                }
            }

            $this->product->update($id, $data);

            if (
                $flagUpload
                && $product['img_thumbnail']
                && file_exists(PATH_ROOT . $product['img_thumbnail'])
            ) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url("admin/products/$id/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        try {
            $product = $this->product->findByID($id);

            $this->product->delete($id);

            if ($product['img_thumbnail'] && file_exists(PATH_ROOT . $product['img_thumbnail'])) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';
        } catch (\Throwable $th) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
        }

        header('Location: ' . url('admin/products'));
        exit();
    }

    // public function stats()
    // {
    //     $stats = $this->product->countByCategory();

    //     $this->renderViewAdmin('products.stats', [
    //         'stats' => $stats
    //     ]);
    // }
}
