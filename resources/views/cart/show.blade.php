@extends('app')

@section('content')
    <main id="maincontent" class="page-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/" target="_self">Giỏ hàng</a></li>
                        <li><span>/</span></li>
                        <li class="active"><span>Thông tin giao hàng</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <aside class="col-md-6 cart-checkout">
                    <form action="{{ route('order') }}" method="POST">
                        @csrf

                      @foreach ($cartItems as $productId => $item)
                            <input type="hidden" name="order_items[{{ $loop->index }}][product_id]" value="{{  $item['id']  }}">

                            <input type="hidden" name="order_items[{{ $loop->index }}][qty]" value="{{ $item['quantity'] }}">
                            <input type="hidden" name="order_items[{{ $loop->index }}][unit_price]" value="{{ $item['price'] }}">
                            <div class="row">
                                <div class="col-xs-2">
                                    <img class="img-responsive" src="{{ asset($item['image']) }}" alt="">
                                </div>
                                <div class="col-xs-7">
                                    <a class="product-name" href="chi-tiet-san-pham.html">{{ $item['name'] }}</a>
                                    <br>
                                    <span>{{ $item['quantity'] }}</span> x
                                    <span>{{ number_format($item['price'], 0, '', '.') }}</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <span>{{ number_format($item['price'] * $item['quantity'], 0, '', '.') }}</span>
                                    <a class="remove-product" href="{{ route('cart.remove', $item['id'] ) }}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính
                            </div>
                            <div class="col-xs-6 text-right">
                                <span class="payment-total" id="total-price">{{ number_format($totalPrice, 0, '', '.') }}₫</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Phí vận chuyển
                            </div>
                            <div class="col-xs-6 text-right">

                                <span class="shipping-fee">₫<span id="shipping-fee-value" name="shipping_fee">0</span></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tổng cộng
                            </div>
                            <div class="col-xs-6 text-right">
                                <span class="payment-total" id="final-total">{{ number_format($totalPrice, 0, '', '.') }}₫</span>
                            </div>
                        </div>
                </aside>

                <div class="ship-checkout col-md-6">
                    <h4>Thông tin giao hàng</h4>
                    <div>Bạn đã có tài khoản? <a href="javascript:void(0)" class="btn-login">Đăng Nhập </a></div>
                    <br>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="text" value="{{ Auth::guard('customer')->user()->name }}" class="form-control" name="name" placeholder="Họ và tên" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="tel" value="{{ Auth::guard('customer')->user()->mobile }}" class="form-control" name="mobile" placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
                        </div>
                        @include('layout.information_form')
                    </div>
                    <h4>Phương thức thanh toán</h4>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng (COD) </label>
                        <div></div>
                    </div>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng </label>
                        <div class="bank-info">
                            STK: 1024446604<br>
                            Chủ TK: Phan Hữu Tín. Ngân hàng: Vietcombank TP.HCM <br>
                            Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
