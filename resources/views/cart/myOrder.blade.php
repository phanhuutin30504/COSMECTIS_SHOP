@extends('app')

@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
           @include('layout.aside_info')
            <div class="col-md-9 order">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng của tôi</h4>
                    </div>
                    <div class="clearfix"></div>
                    @php
                        $stt =0;
                    @endphp

                    @foreach ($myOrder as $order)

                    <div class="col-md-12">
                        <!-- Mỗi đơn hàng -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Đơn hàng <a href="chi-tiet-don-hang.html">#{{ ++$stt  }}</a></h5>
                                <span class="date">
                                    Đặt hàng ngày: {{ $order->created_at }}
                                </span>
                                <hr>

                                <!-- Vòng lặp cho từng sản phẩm trong đơn hàng -->
                                @foreach ($order->items as $item)

                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{asset($item->product->featured_image)}}" alt="" class="img-responsive">
                                        </div>
                                        <div class="col-md-3">
                                            <a class="product-name" href="chi-tiet-san-pham.html">{{ $item->product->name }}</a>
                                        </div>
                                        <div class="col-md-2">
                                            Số lượng: {{ $item->qty }}
                                        </div>

                                        <div class="col-md-2">
                                         {{$order->status->description}}
                                        </div>
                                        <div class="col-md-3">
                                            Giao hàng ngày: {{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
