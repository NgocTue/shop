@extends('layout.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h1 class="m-0">Xem chi tiết</h1>
                </div>
            </div>
        </div>
        <div class="white_card_body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>TRƯỜNG</th>
                            <th>GIÁ TRỊ</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        @foreach ($product as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{!! $value !!}</td>
                            </tr>
                        @endforeach
            
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="{{ url("admin/products/") }}" class="btn btn-success">Trở về</a>
                    <a href="{{ url("admin/products/{$product['id']}/edit") }}" class="btn btn-warning">Sửa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection