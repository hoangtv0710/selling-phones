<!-- jquery -->
<script src="assets/client/js/jquery-2.2.3.min.js"></script>
<!-- //jquery -->

<!-- popup modal (for location)-->
<script src="assets/client/js/jquery.magnific-popup.js"></script>
<!-- //popup modal (for location)-->

<!-- cart-js -->
<script src="assets/client/js/minicart.js"></script>
<!-- //cart-js -->


<!-- scroll seller -->
<script src="assets/client/js/scroll.js"></script>
<!-- //scroll seller -->

<!-- smoothscroll -->
<script src="assets/client/js/SmoothScroll.min.js"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
<script src="assets/client/js/move-top.js"></script>
<script src="assets/client/js/easing.js"></script>


<script src="assets/client/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- //js-files -->
<script src="assets/client/js/custom.js"></script>
<script src="assets/admin/js/toastr.min.js"></script>
@yield('script')
@if(session('thongbao'))
  <script>
      toastr.success('{{ session('thongbao') }}', 'Thông báo', {timeOut: 4000});
  </script>
@endif
@if(session('error'))
  <script>
      toastr.error('{{ session('error') }}', 'Thông báo', {timeOut: 4000});
  </script>
@endif