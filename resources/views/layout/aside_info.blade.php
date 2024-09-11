<aside class="col-md-3">
    <div class="inner-aside">
        <div class="category">
            <ul>
                <li class="{{ request()->is('show-customer/*') ? 'active' : ''}}">
                    <a href="{{ route('show.customer', Auth::guard('customer')->user()->id) }}" title="Thông tin tài khoản" target="_self">Thông tin tài khoản</a>
                </li>
                <li class="{{ request()->is('shipping-default/*') ? 'active' : ''}}">
                    <a href="{{ route('shipping.customer', Auth::guard('customer')->user()->id) }}" title="Địa chỉ giao hàng mặc định" target="_self">Địa chỉ giao hàng mặc định</a>
                </li>
                <li class="{{ request()->is('my-order/*') ? 'active' : ''}}">
                    <a href="{{ route('myOrder', Auth::guard('customer')->user()->id) }}" target="_self">Đơn hàng của tôi</a>
                </li>
            </ul>
        </div>
    </div>
</aside>
