
<div class="col-xs-6 col-sm-3">
    <div class="product-container">
        <div class="image">
            <img class="img-responsive" src="{{ asset($product->featured_image) }}" alt="">
        </div>
        <div class="product-meta">
            <h5 class="name">
                <a class="product-name" href="{{route('product.detail',$product->id)}}"
                    title="{{ $product->name }}">{{ $product->name }}</a>
            </h5>
            <div class="product-item-price">

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
        </div>
        <div class="button-product-action clearfix">
            <div class="cart icon">

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" class="product-quantity form-control" value="1" min="1">
                <button class="btn btn-outline-inverse buy"
                    title="Thêm vào giỏ">
                    Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
                </button>
                </form>
            </div>
            <div class="quickview icon">
                <a class="btn btn-outline-inverse" href="{{route('product.detail',$product->id)}}" title="Xem nhanh">
                    Xem chi tiết <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
    </div>
</div>
