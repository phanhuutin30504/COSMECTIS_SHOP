@extends('app')
@section('content')
    <div class="slideshow container-fluid">
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{ asset('upload/slider1.jpg') }}" alt="slider 1">
                    </div>

                    <div class="item">
                        <img src="{{ asset('upload/slider_2.jpg') }}" alt="slider 2">
                    </div>

                    <div class="item">
                        <img src="{{ asset('upload/slider_3.jpg') }}" alt="slider 3">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- END SLIDESHOW -->
    <!-- SERVICES -->
    <div class="top-services container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 item item-1">
                <div class="item-inner">
                    <a class="item-inline" title="7 NGÀY ĐỔI TRẢ" href="#">
                        <span class="title-sv">7 NGÀY ĐỔI TRẢ</span>
                        <span>Chăm sóc khách hàng cực tốt</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 item item-2">
                <div class="item-inner">
                    <a class="item-inline" title="MIỄN PHÍ SHIP" href="#">
                        <span class="title-sv">MIỄN PHÍ SHIP</span>
                        <span>Với dịch vụ giao hàng tiết kiệm</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 item item-3">
                <div class="item-inner">
                    <a class="item-inline" title="BÁN BUÔN NHƯ BÁN SỈ" href="#">
                        <span class="title-sv">BÁN BUÔN NHƯ BÁN SỈ</span>
                        <span>Giá hợp lý nhất quả đất</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 item item-4">
                <div class="item-inner">
                    <a class="item-inline" title="CHẤT LƯỢNG HÀNG ĐẦU" href="#">
                        <span class="title-sv">CHẤT LƯỢNG HÀNG ĐẦU</span>
                        <span>Chăm sóc bạn như người thân </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main id="maincontent" class="page-main">
        <div class="container">
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Sản phẩm nổi bật</h4>
                </div>
                @foreach ($products as $item)
                    <div class="col-xs-6 col-sm-3">
                        <div class="product-container">
                            <div class="image">
                                <img class="img-responsive" src="{{ asset($item->featured_image) }}" alt="">
                            </div>
                            <div class="product-meta">
                                <h5 class="name">
                                    <a class="product-name" href="chi-tiet-san-pham.html"
                                        title="Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream">{{ $item->name }}</a>
                                </h5>
                                <div class="product-item-price">

                                    @if (!$item->discount_percentage)
                                        <span class="product-item-discount">{{ number_format($item->price, 0, '', '.') }}
                                            ₫
                                        </span>
                                    @else
                                        @php
                                            $salePrice =
                                                $item->price - ($item->price * $item->discount_percentage) / 100;
                                        @endphp
                                        <span class="product-item-regular">{{ number_format($item->price, 0, '', '.') }}
                                            ₫</span>

                                            <span class="product-item-discount">{{ number_format($salePrice, 0, '', '.') }}
                                                ₫</span>
                                    @endif


                                </div>
                            </div>
                            <div class="button-product-action clearfix">
                                <div class="cart icon">
                                    <a class="btn btn-outline-inverse buy" product-id="2" href="javascript:void(0)"
                                        title="Thêm vào giỏ">
                                        Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="quickview icon">
                                    <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                        Xem chi tiết <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Sản phẩm mới nhất</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/beaumoreSecretWhiteningCream10g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream">Kem làm trắng da 5
                                    trong 1 Beaumore Secret Whitening Cream</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-regular">200,000₫</span>
                                <span class="product-item-discount">190,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="2" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/beaumoreContourEyeCream.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem dưỡng da vùng mắt Beaumore Contour Eye Cream- 10g">Kem dưỡng da vùng mắt
                                    Beaumore Contour Eye Cream- 10g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">300,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="14" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemLamSangVungDaBikini.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm sáng vùng da bikini Beaumore- 50ml">Kem làm sáng vùng da bikini
                                    Beaumore- 50ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">849,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaTamSandrasShowerGel.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Sữa tắm Sandras Shower Gel">Sữa tắm Sandras Shower Gel</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">180,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="7" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Kem Chống Nắng</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemChongNangBeaumore4in1.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm trắng bảo vệ da chống nắng dùng làm kem nền khi trang điểm Beaumore 4 in 1 Cream- 40ml">Kem
                                    làm trắng bảo vệ da chống nắng dùng làm kem nền khi trang điểm Beaumore 4 in 1 Cream-
                                    40ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">604,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="12" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemChongNangSunDefense80ml.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html3"
                                    title="Kem chống nắng Beaumore - 80ml - giá sỉ​, giá tốt
                                Kem chống nắng Beaumore - 80ml">Kem
                                    chống nắng Beaumore - 80ml - giá sỉ​, giá tốt
                                    Kem chống nắng Beaumore - 80ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">249,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="23" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html3" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Kem Dưỡng Da</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/beaumoreContourEyeCream.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem dưỡng da vùng mắt Beaumore Contour Eye Cream- 10g">Kem dưỡng da vùng mắt
                                    Beaumore Contour Eye Cream- 10g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">300,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="14" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemLamSangVungDaBikini.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm sáng vùng da bikini Beaumore- 50ml">Kem làm sáng vùng da bikini
                                    Beaumore- 50ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">849,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaTamSandrasShowerGel.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Sữa tắm Sandras Shower Gel">Sữa tắm Sandras Shower Gel</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">180,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="7" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/nhamSamSandrasBeauty20g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm trắng da và mờ nếp nhăn từ Nhân sâm Sandras Beauty- 20g ">Kem làm trắng
                                    da và mờ nếp nhăn từ Nhân sâm Sandras Beauty- 20g </a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">380,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="13" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Kem Trị Mụn</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemTriMunNghePureTurmeric20g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html5"
                                    title="Kem trị mụn nghệ Nhật Beaumore Pure Turmeric Cream (Mới)- 20g ">Kem trị mụn nghệ
                                    Nhật Beaumore Pure Turmeric Cream (Mới)- 20g </a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">239,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="25" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html5" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Kem Trị Thâm Nám</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/beaumoreSecretWhiteningCream10g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream">Kem làm trắng da 5
                                    trong 1 Beaumore Secret Whitening Cream</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-regular">200,000₫</span>
                                <span class="product-item-discount">190,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="2" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemPhaiNamVaTanNhanBeaumore.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm phai vết nám và tàn nhang Beaumore- 15g">Kem làm phai vết nám và tàn
                                    nhang Beaumore- 15g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">249,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="16" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemTrangDaHoPhachBeaumore30g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm trắng da ngăn ngừa nám và tàn nhang từ hổ phách Beaumore- 30g">Kem làm
                                    trắng da ngăn ngừa nám và tàn nhang từ hổ phách Beaumore- 30g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">520,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="15" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/kemLamMoNamNgayDemDoiMy.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Kem làm mờ nám Ngày Đêm Nám đôi Mỹ Beaumore- 10g x 2 hũ">Kem làm mờ nám Ngày Đêm
                                    Nám đôi Mỹ Beaumore- 10g x 2 hũ</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">901,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="19" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Sữa Rửa Mặt</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaRuaMatHatMo120g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html4"
                                    title="Sữa rửa mặt hạt mơ Beaumore- 120g ">Sữa rửa mặt hạt mơ Beaumore- 120g </a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">180,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="24" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html4" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaRuaMatNgheBeaumore100g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Sữa rửa mặt nghệ Beaumore Mới- 100g">Sữa rửa mặt nghệ Beaumore Mới- 100g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">250,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="4" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaRuamatHAAmino75g.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html2"
                                    title="Sữa rửa mặt HA Amino Beaumore- 75g">Sữa rửa mặt HA Amino Beaumore- 75g</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">520,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="22" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html2" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title">Sữa Tắm</h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/suaTamSandrasMychai250ml.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Sữa tắm Sandras Mỹ chai 250ml">Sữa tắm Sandras Mỹ chai 250ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">210,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="9" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="product-container">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset('upload/aromaWhiteMaximumBeaumore250ml.jpg') }}"
                                alt="">
                        </div>
                        <div class="product-meta">
                            <h5 class="name">
                                <a class="product-name" href="chi-tiet-san-pham.html"
                                    title="Sữa tắm trắng Aroma White Maximum Beaumore- 250ml">Sữa tắm trắng Aroma White
                                    Maximum Beaumore- 250ml</a>
                            </h5>
                            <div class="product-item-price">
                                <span class="product-item-discount">180,000₫</span>
                            </div>
                        </div>
                        <div class="button-product-action clearfix">
                            <div class="cart icon">
                                <a class="btn btn-outline-inverse buy" product-id="17" href="javascript:void(0)"
                                    title="Thêm vào giỏ">
                                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="quickview icon">
                                <a class="btn btn-outline-inverse" href="chi-tiet-san-pham.html" title="Xem nhanh">
                                    Xem chi tiết <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
