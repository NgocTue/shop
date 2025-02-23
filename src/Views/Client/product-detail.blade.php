<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            {{-- <h1 class="mt-5">Welcome {{ $name }} to my website!</h1> --}}

            <nav class="text-end mb-3">
                @if (!isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                @endif

                @if (isset($_SESSION['user']))
                <a class="btn btn-danger" href="{{ url('logout') }}">Logout</a>
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

        <div class="row text-center">

            <div class="col-md-4 mb-2 mt-2">
                <div class="card">
                    <img class="card-img-top" style="max-height: 200px" src="{{ asset($product['img_thumbnail']) }}" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product['name'] }}</h4>
                        <p>{{ $product['content'] }}</p>

                        <form action="{{ url('cart/add') }}" method="get">
                            <input type="hidden" name="productID" value="{{ $product['id'] }}">
                            <input type="number" min="1" name="quantity" value="1">
                            <button type="submit" class="btn btn-warning">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>