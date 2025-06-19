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

            <form id="order-form" action="{{ route('order') }}" method="POST">
                @csrf
                <div class="row">
                    <aside class="col-md-6 cart-checkout">
                        @foreach ($cartItems as $productId => $item)
                            <input type="hidden" name="order_items[{{ $loop->index }}][product_id]"
                                value="{{ $item['id'] }}">
                            <input type="hidden" name="order_items[{{ $loop->index }}][qty]"
                                value="{{ $item['quantity'] }}">
                            <input type="hidden" name="order_items[{{ $loop->index }}][unit_price]"
                                value="{{ $item['price'] }}">

                            <div class="row">
                                <div class="col-xs-2">
                                    <img class="img-responsive" src="{{ asset($item['image']) }}" alt="">
                                </div>
                                <div class="col-xs-7">
                                    <a class="product-name" href="#">{{ $item['name'] }}</a><br>
                                    <span>{{ $item['quantity'] }}</span> x
                                    <span>{{ number_format($item['price'], 0, '', '.') }}</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <span>{{ number_format($item['price'] * $item['quantity'], 0, '', '.') }}</span>
                                    <a class="remove-product" href="{{ route('cart.remove', $item['id']) }}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <div class="row">
                            <div class="col-xs-6">Tạm tính</div>
                            <div class="col-xs-6 text-right">
                                <span class="payment-total"
                                    id="total-price">{{ number_format($totalPrice, 0, '', '.') }}₫</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Phí vận chuyển</div>
                            <div class="col-xs-6 text-right">
                                <span class="shipping-fee">₫<span id="shipping-fee-value"
                                        name="shipping_fee">0</span></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">Tổng cộng</div>
                            <div class="col-xs-6 text-right">
                                <span class="payment-total"
                                    id="final-total">{{ number_format($totalPrice, 0, '', '.') }}₫</span>
                            </div>
                        </div>
                    </aside>

                    <div class="ship-checkout col-md-6">
                        <h4>Thông tin giao hàng</h4>
                        <div>Bạn đã có tài khoản? <a href="javascript:void(0)" class="btn-login">Đăng Nhập</a></div><br>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <input type="text" value="{{ Auth::guard('customer')->user()->name }}"
                                    class="form-control" name="name" placeholder="Họ và tên" required
                                    oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="tel" value="{{ Auth::guard('customer')->user()->mobile }}"
                                    class="form-control" name="mobile" placeholder="Số điện thoại" required
                                    pattern="[0][0-9]{9,}"
                                    oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            @include('layout.information_form')
                        </div>

                        <h4>Phương thức thanh toán</h4>
                        <div class="form-group">
                            <label><input type="radio" name="payment_method" value="0" checked> Thanh toán khi giao
                                hàng (COD)</label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="payment_method" value="1"> Chuyển khoản ngân hàng (Quét
                                mã QR)</label>
                            <div class="bank-info" style="margin-left: 20px; margin-top: 5px;">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Modal xác nhận chuyển khoản -->
    <div class="modal fade" id="bankTransferModal" tabindex="-1" role="dialog" aria-labelledby="bankTransferLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 95%; height:95%; max-width: 1200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận chuyển khoản</h5>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        {{-- <div class="mb-3 h5"><strong>Chi tiết thanh toán</strong></div> --}}
                        <div class="" style="border-radius: 10px; background-color: #f0f8ff; padding: 20px;">
                            <div class="" style="border-bottom: 1px solid #999; padding-bottom: 10px;">
                                <span style=" font-size: 16px; font-weight: bold;">Chi tiết thanh toán </span>
                                @foreach ($cartItems as $productId => $item)
                                    <div style="margin-left:10px;">
                                        <span>{{ $item['quantity'] }}</span> <a class="product-name" href="#">{{ $item['name'] }}</a>
                                    </div>
                                @endforeach
                            </div>

                            <div style="margin-top: 10px; display: table; width: 100%;">
                                <div class="table-cell" style="display: table-cell; font-size: 16px; font-weight: bold;">
                                    Tổng tiền:
                                </div>
                                <div class="table-cell text-right"
                                    style="display: table-cell; font-size: 24px; font-weight: bold; color: #007bff;">
                                    {{ number_format($totalPrice, 0, '', '.') }}&nbsp;₫
                                </div>
                            </div>

                        </div>
                        <div style="padding:10px; ">
                            <i style="color:red;">(*) Lưu ý</i>
                            <div>
                                <span style="color:red;">
                                    Vui lòng khi chuyển khoản kiểm tra nội dung và thông tin chuyển khoản hợp lệ. Nếu có
                                    thắc mắc hoặc khiếu nại vui lòng liên hệ 0326254914
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" style="display: flex; align-items: center;">
                            <!-- Cột QR -->
                            <div>
                                <img src="https://qr.sepay.vn/img?bank=ACB&acc=18196731&template=&amount={{$totalPrice}}&des=MUAHANG" alt="QR Code" style="max-width: 200px;" />
                            </div>
                            <!-- Cột các bước (nằm giữa theo chiều dọc của ảnh) -->
                            <div>
                                <div style="margin-bottom: 10px;">
                                    ✅ <strong>Bước 1:</strong> Mở app ngân hàng và quét mã QR
                                </div>
                                <div style="margin-bottom: 10px;">
                                    ✅ <strong>Bước 2:</strong> Đảm bảo nội dung là <span class="text-primary">MUAHANG</span>
                                </div>
                                <div>
                                    ✅ <strong>Bước 3:</strong> Thực hiện thanh toán
                                </div>
                            </div>
                        </div>
                        <!-- Chuyển khoản thủ công -->
                        <div style="margin-top: 30px;">
                            <strong>Chuyển khoản thủ công:</strong>
                            <p>Vui lòng chuyển khoản vào tài khoản ngân hàng sau:</p>
                            <ul>
                                <li><strong>Ngân hàng:</strong> ACB</li>
                                <li><strong>Số tài khoản:</strong> 18196731</li>
                                <li><strong>Số tiền:</strong> {{ number_format($totalPrice, 0, '', '.') }} VND</li>
                                <li><strong>Nội dung:</strong> <span class="text-primary">MUAHANG</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary" id="confirm-transfer">Xác nhận</button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery xử lý chuyển khoản -->
    <script>
        $(document).ready(function() {
            $('#order-form').on('submit', function(e) {
                const paymentMethod = $('input[name="payment_method"]:checked').val();
                if (paymentMethod === '1') {
                    e.preventDefault(); // chặn submit
                    $('#bankTransferModal').modal('show');
                }
            });

            $('#confirm-transfer').on('click', function() {
                $('#bankTransferModal').modal('hide');
                // Gỡ bỏ submit cũ để tránh chặn lại
                $('#order-form').off('submit').submit();
            });
        });
    </script>
@endsection
