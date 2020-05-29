<!-- Bootstrap core JavaScript-->
<script src="assets/admin/vendor/jquery/jquery.min.js"></script>
<script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/admin/js/sb-admin-2.min.js"></script>
<script src="assets/admin/js/toastr.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
@yield('script')
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