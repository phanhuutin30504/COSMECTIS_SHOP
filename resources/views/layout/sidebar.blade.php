<aside class="col-md-3">
    <div class="inner-aside">
        <div class="category">
            <h5>Danh mục sản phẩm</h5>
            <ul>
                <li class="{{ !request()->has('category') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" title="Tất cả sản phẩm" target="_self">Tất cả sản phẩm</a>
                </li>

                @foreach ($categories as $category)
                    <li class="{{ request()->input('category') == $category->id ? 'active' : '' }}">
                        <a href="{{ route('product.index', ['category' => $category->id]) }}"
                            title="{{ $category->name }}" target="_self">{{ $category->name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="price-range">
            <h5>Khoảng giá</h5>
            <form method="GET" action="{{ route('product.index') }}">
                <ul>
                    <li>
                        <label for="filter-less-100">
                            <input type="radio" id="filter-less-100" name="filter-price" value="0-100000"
                                {{ request('filter-price') === '0-100000' ? 'checked' : '' }}>
                            Giá dưới 100.000đ
                        </label>
                    </li>
                    <li>
                        <label for="filter-100-200">
                            <input type="radio" id="filter-100-200" name="filter-price" value="100000-200000"
                                {{ request('filter-price') === '100000-200000' ? 'checked' : '' }}>
                            100.000đ - 200.000đ
                        </label>
                    </li>
                    <li>
                        <label for="filter-200-300">
                            <input type="radio" id="filter-200-300" name="filter-price" value="200000-300000"
                                {{ request('filter-price') === '200000-300000' ? 'checked' : '' }}>
                            200.000đ - 300.000đ
                        </label>
                    </li>
                    <li>
                        <label for="filter-300-500">
                            <input type="radio" id="filter-300-500" name="filter-price" value="300000-500000"
                                {{ request('filter-price') === '300000-500000' ? 'checked' : '' }}>
                            300.000đ - 500.000đ
                        </label>
                    </li>
                    <li>
                        <label for="filter-500-1000">
                            <input type="radio" id="filter-500-1000" name="filter-price" value="500000-1000000"
                                {{ request('filter-price') === '500000-1000000' ? 'checked' : '' }}>
                            500.000đ - 1.000.000đ
                        </label>
                    </li>
                    <li>
                        <label for="filter-greater-1000">
                            <input type="radio" id="filter-greater-1000" name="filter-price" value="1000000-greater"
                                {{ request('filter-price') === '1000000-greater' ? 'checked' : '' }}>
                            Giá trên 1.000.000đ
                        </label>
                    </li>
                </ul>
               <ul> <button class="button-4 justify-content-center" role="button">Lọc theo giá</button></ul>
            </form>
        </div>
    </div>
</aside>
