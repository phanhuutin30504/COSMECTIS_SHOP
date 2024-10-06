@include('admin.Layout_admin.head')
<body class="bg-dark">
<div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header card-header-login">
        <img src="images/logo.jpg">
      </div>
      @if ($errors->any())
      <div class="alert alert-danger text-center ">
          <ul class="list-unstyled">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
      <div class="card-body">
        <form action="{{route('login')}}" method="POST">
            @csrf

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Tài khoản" required="required" autofocus="autofocus">
              <label for="username">Tài khoản</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required="required" name="password">
              <label for="password">Mật khẩu</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me" name="remember-me">
                Nhớ mật khẩu
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" >Đăng nhập</button>
        </form>
      </div>
    </div>
  </div>
@include('admin.Layout_admin.footer')
