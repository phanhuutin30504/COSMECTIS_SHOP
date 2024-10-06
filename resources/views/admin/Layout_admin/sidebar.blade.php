<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="../../pages/dashboard/index.html"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng
                quan</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/order/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/order/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown {{ request()->routeIs('admin.product','admin.product.create','admin.products.showImages','admin.comment','admin.product.edit')   ? 'show active' : '' }}">
        <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" id="">
            <i class="fab fa-product-hunt"></i> <span>Sản phẩm</span>
        </a>
        <div class="dropdown-menu {{ request()->routeIs('admin.product','admin.product.create','admin.products.showImages','admin.comment')   ? 'show' : '' }}" aria-labelledby="">
            <a class="dropdown-item {{ request()->routeIs('admin.product') ? 'active' : '' }}" href="{{route('admin.product')}}">Danh sách</a>
            <a class="dropdown-item {{ request()->routeIs('admin.product.create') ? 'active' : '' }}" href="{{route('admin.product.create')}}">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown {{ request()->routeIs('admin.customer','admin.customer.create','admin.customer.show') ? 'show active' : '' }}">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-user-alt"></i> <span>Khách hàng</span></a>
        <div class="dropdown-menu {{ request()->routeIs('admin.customer','admin.customer.create','admin.customer.show') ? 'show ' : '' }}" aria-labelledby="">
            <a class="dropdown-item {{ request()->routeIs('admin.customer')  ? ' active' : '' }}" href="{{route('admin.customer')}}">Danh sách</a>
            <a class="dropdown-item {{ request()->routeIs('admin.customer.create')  ? ' active' : '' }}" href="{{route('admin.customer.create')}}">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown {{ request()->routeIs('admin.category','admin.category.create','admin.category.show') ? 'show active' : '' }}">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-folder"></i> <span>Danh mục</span></a>
        <div class="dropdown-menu {{ request()->routeIs('admin.category','admin.category.create','admin.category.show')  ? 'show ' : '' }}" aria-labelledby="">
            <a class="dropdown-item {{ request()->routeIs('admin.category') ? ' active' : '' }}" href="{{route('admin.category')}}">Danh sách</a>
            <a class="dropdown-item {{ request()->routeIs('admin.category.create') ? ' active' : '' }}" href="{{route('admin.category.create')}}">Thêm</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-percentage"></i> <span>Khuyến mãi</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/promotion/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/promotion/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-shipping-fast"></i> <span>Phí giao hàng</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/transport/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/transport/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdow">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-users"></i> <span>Nhân viên</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/staff/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/staff/add.html">Thêm</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/permission/roles.html">Danh sách vai trò</a>
            <a class="dropdown-item" href="../../pages/permission/add_role.html">Thêm vai trò</a>
            <a class="dropdown-item" href="../../pages/permission/actions.html">Danh sách tác vụ</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../../pages/order_status/list.html"><i class="fas fa-star-half-alt"></i>
            <span>Trạng thái đơn hàng</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i
                class="fas fa-file-alt"></i> <span>News letter</span></a>
        <div class="dropdown-menu" aria-labelledby="">
            <a class="dropdown-item" href="../../pages/newsletter/list.html">Danh sách</a>
            <a class="dropdown-item" href="../../pages/newsletter/send.html">Gởi mail</a>
        </div>
    </li>
</ul>
