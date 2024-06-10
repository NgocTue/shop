@extends('layout.master')

@section('title')
    Thêm mới danh mục
@endsection

@section('content')
<div class="row justify-content-center">

    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Thêm mới</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                @if (!empty($_SESSION['errors']))
                <div class="alert alert-warning">
                    <ul>
                    @foreach ($_SESSION['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
            
                    @php
                        unset($_SESSION['errors']);
                    @endphp
                </div>
                @endif

                <div class="table-responsive">
                    <form action="{{ url ('admin/categories/store') }}" enctype="multipart/form-data" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                        </div>
                
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url("admin/categories/") }}" class="btn btn-success">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
