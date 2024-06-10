<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            {{-- <h3 class="mt-5">Welcome {{$name}} to my website</h3> --}}
            <marquee behavior="" direction="">Welcome {{$name}} to my website</marquee>

            <nav class="text-end">
                @if (!isset($_SESSION['user']))
                    <a href="{{url('login')}}" class="btn btn-primary">Login</a>
                @endif
                
                @if (isset($_SESSION['user']))
                    <a href="{{url('logout')}}" class="btn btn-danger">Logout</a>
                @endif
            </nav>
        </div>
        <nav class="navbar navbar-expand-sm bg-light shadow">

            <div class="container">
                <!-- Links -->
                <div class="d-flex align-items-center">
                    <!-- khu vực logo-->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="" href="">
                                <img src="/img/logo_bootstrap.webp" alt="" width="80">
                            </a>
                        </li>
                    </ul>
    
                    <!-- khu vực menu -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('')}}">Trang chủ</a>
                        </li>
                    </ul>
                </div>
            </div>
    
        </nav>
        <!-- Carousel -->
        {{-- <div id="demo" class="carousel slide overflow-hidden" data-bs-ride="carousel" style="height: 303px;">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="shop/assets/img/banner shop2.jpg" alt="Los Angeles" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="shop/assets/img/banner shop3.png" alt="Chicago" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="shop/assets/img/banner shop4.webp" alt="New York" class="d-block w-100">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div> --}}

        {{-- <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="{{asset($product['img_thumbnail'])}}" alt="Card image">
                        <div class="card-body">
                          <h4 class="card-title">{{$product['name']}}</h4>
                          <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

        <div class="row">
            @foreach ($products as $product)
                <div class="col-3">
                    <!--box hiển thị sản phẩm-->
                    <div class="border rounded overflow-hidden mt-3 mb-3">
                        <!--khu vực ảnh-->
                        <div style="height: 458px;" class="d-flex align-items-center justify-content-center bg-light">
                            <a href="{{url('products/' . $product['id']) }}">
                                <img src="{{asset($product['img_thumbnail'])}}" class="mh-100 mw-100" alt="">
                            </a>
                        </div>
        
                    <div class="m-2">
                            <!--khu vực tên sản phẩm-->
                            <h1 class="h5 text-center" style="height: 48px;">
                                <a href="{{url('products/' . $product['id']) }}">{{$product['name']}}</a>
                            </h1>
        
                            <!--khu vực giá sản phẩm-->
                            <!--giá niêm yết-->
                            {{-- <div class="d-flex justify-content-between">
                                <div class="text-decoration-line-through">{{$product['price_regular']}}</div>
                                <div>{{$product['price_sale']}}</div>
                            </div> --}}
        
                            <!--khu vực button tương tác-->
                            <div class="row">
                                <div class="col">
                                        <a href="{{url('products/' . $product['id']) }}" class="btn btn-warning rounded-pill w-100"><i class="fa-solid fa-eye"></i> Xem</a>
                                </div>
                                <div class="col">
                                    <!-- <button class="btn btn-danger rounded-pill w-100"><i class="fa-solid fa-cart-shopping"></i> Mua ngay</button> -->
                                    <a href="{{url('cart/add')}}?quantity=1&productID={{$product['id']}}" class="btn btn-danger rounded-pill w-100">
                                        <i class="fa-solid fa-cart-shopping"></i> Mua ngay</a>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Khu vực phân trang -->
    <div class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="{{ url() }}">1</a></li>
            <li class="page-item"><a class="page-link" href="{{ url() }}">2</a></li>
            <li class="page-item"><a class="page-link" href="{{ url() }}">3</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
    <div class="text-center mt-5" style="background-color: rgb(68, 71, 90); color: aliceblue;">
        <div class="row">
            {{-- <div class="col-3 mt-5">
                <img src="/img/logo_bootstrap.webp" alt="image" width="120px">
            </div> --}}
            <div class="col-4 mt-3">
                <b>SẢN PHẨM</b>
                <p>Gucci</p>
                <p>Cardigan</p>
                <p>Chanel</p>
                <p>MLB</p>
            </div>

            <div class="col-4 mt-3">
                <b>CHÍNH SÁCH BẢO HÀNH</b>
                <p>Đổi trả khi gặp vấn đề</p>
                <p>Bảo hành 12 tháng</p>
                <p>Hỗ trợ tư vấn nhiệt tình</p>
                <p>Cam kết chất lượng</p>
            </div>

            <div class="col-4 mt-3">
                <b>THÔNG TIN LIÊN HỆ</b>
                <p><i class="fa-solid fa-location-dot"></i> 124/49 Hòe Thị - Phương Canh - Nam Từ Liêm - Hà Nội</p>
                <p><i class="fa-solid fa-phone"></i> 0916839524</p>
                <p><i class="fa-brands fa-facebook"></i> NgocTue Nguyen</p>
                <p><i class="fa-brands fa-tiktok"></i> ngoctue_0208</p>
            </div>
        </div>
    </div>
</body>
</html>