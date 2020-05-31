<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Thay đổi mật khẩu </title>

    <base href="{{ asset('') }}"
    <!-- Custom fonts for this template-->
    <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/admin/css/toastr.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Nhập mật khẩu mới</h1>
                  </div>
                  <form class="user" action="{{  route('new_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $info }}">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Mật khẩu mới" autofocus>
                       @if($errors->has('password'))
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
             
                    <div class="form-group mt-1">
                      <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Xác nhận mật khẩu">
                      @if($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                      @endif
                    </div>

                    <button type="submit" class="btn btn-success btn-user btn-block">
                      Đổi mật khẩu
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-user btn-block text-white">
                        <i class="fas fa-long-arrow-alt-left"></i> Trở về trang chủ
                    </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/admin/js/sb-admin-2.min.js"></script>
  <script src="assets/admin/js/toastr.min.js"></script>
    @if(session('thongbao'))
    <script>
        toastr.success('{{ session('thongbao') }}', 'Thông báo', {timeOut: 2000});
    </script>
    @endif
    @if(session('error'))
    <script>
        toastr.error('{{ session('error') }}', 'Thông báo', {timeOut: 2000});
    </script>
    @endif
</body>

</html>
