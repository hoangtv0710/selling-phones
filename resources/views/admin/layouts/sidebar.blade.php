<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Trang chủ</span></a>
    </li>

    <!-- Divider -->
    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true" aria-controls="category">
          <i class="fas fa-folder-open"></i>
          <span>Danh mục sản phẩm</span>
        </a>
        <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Danh mục sản phẩm</h6>
            <a class="collapse-item" href="{{ route('category.index') }}">Danh sách</a>
            <a class="collapse-item" href="{{ route('category.create') }}">Thêm mới</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_type" aria-expanded="true" aria-controls="product_type">
            <i class="fas fa-folder"></i>
            <span>Loại sản phẩm</span>
          </a>
          <div id="product_type" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Loại sản phẩm</h6>
              <a class="collapse-item" href="{{ route('product_type.index') }}">Danh sách</a>
              <a class="collapse-item" href="{{ route('product_type.create') }}">Thêm mới</a>
            </div>
          </div>
        </li>
        @endif

        @if(Auth::user()->role == 1 || Auth::user()->role == 3)
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
                <i class="fas fa-mobile"></i>
                <span>Sản phẩm</span>
              </a>
              <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Sản phẩm</h6>
                  <a class="collapse-item" href="{{ route('product.index') }}">Danh sách</a>
                  <a class="collapse-item" href="{{ route('product.create') }}">Thêm mới</a>
                </div>
              </div>
            </li>
          @endif

          @if(Auth::user()->role == 1 || Auth::user()->role == 4)
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order" aria-expanded="true" aria-controls="order">
                <i class="fas fa-mobile"></i>
                <span>Đơn hàng</span>
              </a>
              <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Sản phẩm</h6>
                  <a class="collapse-item" href="{{ route('order.index') }}">Danh sách</a>
                </div>
              </div>
            </li>
          @endif
  </ul>