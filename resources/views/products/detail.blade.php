@extends('app')
@section('title','Sản phẩm - Mỹ Phẩm Goda')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>

                    <li class="active"><span>{{$product->category->name}}</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-9 product-detail">
                <div class="row product-info">
                    <div class="col-md-6">
                        <img data-zoom-image="{{asset($product->featured_image)}}" class="img-responsive thumbnail main-image-thumbnail" src="{{asset($product->featured_image)}}" alt="">
                        <div class="product-detail-carousel-slider">
                            <div class="owl-carousel owl-theme">
                                <div class="item thumbnail"><img src="{{asset('upload/kemLamSangVungDaBikini.jpg')}}" alt=""></div>
                                <div class="item thumbnail"><img src="{{asset('upload/beaumoreContourEyeCream.jpg')}}" alt=""></div>
                                <div class="item thumbnail"><img src="{{asset('upload/kemChongNangBeaumore4in1.jpg')}}" alt=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="product-name">{{$product->name}}</h5>
                        <div class="brand">
                            <span>Nhãn hàng: </span> <span>{{$product->brand->name}}</span>
                        </div>
                        <div class="product-status">
                            <span>Trạng thái: </span>
                            @if ($product->inventory_qty >0)

                            <span class="label-success">Còn hàng</span>
                            @else
                            <span class="label-warning">Hết hàng</span>
                            @endif
                        </div>
                        <div class="product-item-price">
                            <span>Giá: </span>
                            @if (!$product->discount_percentage)
                            <span class="product-item-discount">{{ number_format($product->price, 0, '', '.') }}
                                ₫
                            </span>
                        @else
                            @php
                                $salePrice = $product->price - ($product->price * $product->discount_percentage) / 100;
                            @endphp
                            <span class="product-item-regular">{{ number_format($product->price, 0, '', '.') }}
                                ₫</span>

                            <span class="product-item-discount">{{ number_format($salePrice, 0, '', '.') }}
                                ₫</span>
                        @endif

                        </div>
                        {{-- <div class="input-group">
                            <input type="number" class="product-quantity form-control" value="1" min="1">

                            <a href="javascript:void(0)" product-id="{{$product->id}}"
                                class="buy-in-detail btn btn-success cart-add-button"><i
                                    class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                        </div> --}}
                        <div class="input-group">

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" class="product-quantity form-control" name="qty" value="1" min="1"> <!-- Số lượng có thể thay đổi -->
                            <button type="submit" class=" btn btn-success cart-add-button"><i
                                class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="row product-description">
                    <div class="col-xs-12">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#product-description" aria-controls="home" role="tab" data-toggle="tab">Mô tả</a>
                                </li>
                                <li role="presentation">
                                    <a href="#product-comment" aria-controls="tab" role="tab" data-toggle="tab">Đánh giá</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="product-description">
                                <p>Mô tả chi tiết</p>
                                <p>{{$product->description}}</p>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="product-comment">
                                    <form class="form-comment" action="{{route('comment.send')}}" method="POST" role="form">
                                        @csrf
                                        <label>Đánh giá của bạn</label>
                                        <div class="form-group">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input class="rating-input" name="star" type="text" title="" value="{{$product->star}}"/>
                                            <input type="text" class="form-control" id="" name="fullname" placeholder="Tên *" required>
                                            <input type="email" name="email" class="form-control" id="" placeholder="Email *" required>
                                            <textarea name="description" id="input" class="form-control" rows="3" required placeholder="Nội dung *"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>
                                    @foreach ($product->comments as $comments)
                                    <div class="comment-list">
                                        <hr>

                                        <span class="date pull-right">{{$comments->created_at}}</span>
                                        <input class="answered-rating-input" name="rating" type="text" title="" value="{{$comments->star}}" readonly />
                                        <span class="by">{{$comments->fullname}}</span>

                                        <span><p>{{$comments->description}}</p></span>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-related equal">
                    <div class="col-md-12">
                        <h4 class="text-center">Sản phẩm liên quan</h4>
                        <div class="owl-carousel owl-theme">

                            @foreach ($relatedProducts as $relatedProduct )

                            <div class="item thumbnail">
                                <div class="product-container">
                                    <div class="image">
                                        <img class="img-responsive" src="{{asset($relatedProduct->featured_image)}}" alt="">
                                    </div>
                                    <div class="product-meta">
                                        <h5 class="name">
                                            <a class="product-name" href="chi-tiet-san-pham.html" title="{{$relatedProduct->name}}">{{$relatedProduct->name}}</a>
                                        </h5>
                                        <div class="product-item-price">
                                            <span class="product-item-discount">{{number_format($relatedProduct->price,'0','','.')}}đ</span>
                                        </div>
                                    </div>
                                    <div class="button-product-action clearfix">
                                        <div class="cart icon">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                                <input type="hidden" class="product-quantity form-control" value="1" min="1">
                                            <button class="btn btn-outline-inverse buy"
                                                title="Thêm vào giỏ">
                                                Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            </form>
                                        </div>
                                        <div class="quickview icon">
                                            <a class="btn btn-outline-inverse" href="{{route('product.detail',$relatedProduct->id)}}" title="Xem nhanh">
                                                Xem chi tiết <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
