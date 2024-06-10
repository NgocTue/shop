<?php

namespace Lenovo\Shop\Controllers\Admin;

use Lenovo\Shop\Commons\Controller;
use Lenovo\Shop\Models\Category;
// use Lenovo\Shop\Commons\Helper;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(){
        [$categories, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('categories.index', [
            'categories' => $categories,
            'totalPage' => $totalPage
        ]);
    }

    public function create()
    {
        $this->renderViewAdmin('categories.create');
    }

    public function store()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required',
            'quantity'              => 'required',
            'image'                 => 'uploaded_file:0,2M,png,jpg,jpeg,webp',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/categories/create'));
            exit;
        } else {
            $data = [
                'name'         => $_POST['name'],
                'quantity'     => $_POST['quantity'],
            ];

            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $from = $_FILES['image']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['image']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['image'] = $to;
                } else {
                    $_SESSION['errors']['image'] = 'Upload image không thành công!!';

                    header('Location: ' . url('admin/categories/create'));
                    exit;
                }
            }
            $this->category->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';
            header('Location: ' . url('admin/categories'));
            exit;
        }
    }

    public function show($id)
    {
        $category = $this->category->findByID($id);
        $this->renderViewAdmin('categories.show', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        $category = $this->category->findByID($id);
        $this->renderViewAdmin('categories.edit', [
            'category' => $category
        ]);
    }

    public function update($id)
    {
        $category = $this->category->findByID($id);
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required',
            'quantity'              => 'required',
            'image'                 => 'uploaded_file:0,2M,png,jpg,jpeg,webp',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/categories/{$category['id']}/edit"));
            exit;
        } else {
            $data = [
                'name'         => $_POST['name'],
                'quantity'     => $_POST['quantity'],
            ];

            $flagUpload = false;

            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

                $flagUpload = true;

                $from = $_FILES['image']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['image']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['image'] = $to;
                } else {
                    $_SESSION['errors']['image'] = 'Upload image không thành công!!';

                    header('Location: ' . url("admin/categories/{$category['id']}/edit"));
                    exit;
                }
            }
            $this->category->update($id, $data);

            if (
                $flagUpload 
                && $category['image'] 
                && file_exists(PATH_ROOT . $category['image'])
                ) {
                unlink(PATH_ROOT . $category['image']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';
            header('Location: ' . url("admin/categories/{$category['id']}/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        $category = $this->category->findByID($id);
        $this->category->delete($id);

        if (
            $category['image'] 
            && file_exists(PATH_ROOT . $category['image'])
            ) {
            unlink(PATH_ROOT . $category['image']);
        }

        header('Location: ' . url('admin/categories'));
        exit();
    }


}