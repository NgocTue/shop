@extends('layout.master')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Danh mục sản phẩm</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">

                <div class="text-end mt-3">
                    <a href="{{ url("admin/categories/create") }}" class="btn btn-success">Thêm mới</a>
                </div>
            
                @if (!empty($_SESSION['status']) && $_SESSION['status'])
                    <div class="alert alert-success">
                        {{ $_SESSION['msg'] }}
                    </div>
            
                    @php
                        unset($_SESSION['status']);
                        unset($_SESSION['msg']);
                    @endphp
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>QUANTITY</th>
                            <th>CREATED_AT</th>
                            <th>UPDATED_AT</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td><?= $category['id'] ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td>
                                        <img src="{{ asset($category['image']) }}" alt="" width="100px">
                                    </td>
                                    <td><?= $category['quantity'] ?></td>
                                    <td><?= $category['created_at'] ?></td>
                                    <td><?= $category['updated_at'] ?></td>
                                    <td>
                                        <a href="{{ url("admin/categories/{$category['id']}/show") }}" class="btn btn-info">Xem</a>
                                        <a href="{{ url("admin/categories/{$category['id']}/edit") }}" class="btn btn-warning">Sửa</a>
                                        <a href="{{ url("admin/categories/{$category['id']}/delete") }}"
                                            onclick="return confirm('Chắc chắn xóa không?');" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection