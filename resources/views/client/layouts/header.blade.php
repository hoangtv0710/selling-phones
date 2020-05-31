<div class="agile-main-top">
        <div class="container-fluid">
            <div class="row main-top-w3l py-2">
                <div class="col-lg-4 header-most-top">
                    <p class="text-white text-lg-left text-center">Offer Zone Top Deals & Discounts
                        <i class="fas fa-shopping-cart ml-1"></i>
                    </p>
                </div>
                <div class="col-lg-8 header-right mt-lg-0 mt-2">
                    <!-- header lists -->
                    <ul>
                        <li class="text-center border-right text-white">
                            <a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
                                <i class="fas fa-map-marker mr-2"></i>Select Location</a>
                        </li>
                        <li class="text-center border-right text-white">
                            <a data-toggle="modal" data-target="#exampleModal" class="text-white">
                                <i class="fas fa-truck mr-2"></i>Track Order</a>
                        </li>
                        <li class="text-center border-right text-white">
                            <i class="fas fa-phone mr-2"></i> 001 234 5678
                        </li>
                        @if(Auth::check() && Auth::user()->status == 1)
                            <li class="text-center border-right text-white">
                                <i class=""></i>Xin chào <b>{{ Auth::user()->name }}</b> </a>
                            </li>
                            <li class="text-center border-right text-white">
                                <a href="{{ route('logout') }}" class="text-white">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất </a>
                            </li>
                            @if(Auth::user()->password == '')
                                <div class="modal fade updatePassword" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center">Cập nhâp mật khẩu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update_password') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="col-form-label">Mật khẩu</label>
                                                        <input type="password" class="form-control" name="password">
                                                        @if ($errors->has('password'))
                                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Nhập lại mật khẩu</label>
                                                        <input type="password" class="form-control" name="confirm_password">
                                                        @if ($errors->has('confirm_password'))
                                                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="right-w3l">
                                                        <input type="submit" class="form-control" value="Cập nhập password">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <li class="text-center border-right text-white">
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
                            </li>
                            <li class="text-center text-white">
                                <a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
                            </li>
                        @endif
                    </ul>
                    <!-- //header lists -->
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal(select-location) -->
    <div id="small-dialog1" class="mfp-hide">
        <div class="select-city">
            <h3>
                <i class="fas fa-map-marker"></i> Please Select Your Location</h3>
            <select class="list_of_cities">
                <optgroup label="Popular Cities">
                    <option selected style="display:none;color:#eee;">Select City</option>
                    <option>Birmingham</option>
                    <option>Anchorage</option>
                    <option>Phoenix</option>
                    <option>Little Rock</option>
                    <option>Los Angeles</option>
                    <option>Denver</option>
                    <option>Bridgeport</option>
                    <option>Wilmington</option>
                    <option>Jacksonville</option>
                    <option>Atlanta</option>
                    <option>Honolulu</option>
                    <option>Boise</option>
                    <option>Chicago</option>
                    <option>Indianapolis</option>
                </optgroup>
                <optgroup label="Massachusetts">
                    <option>Boston</option>
                    <option>Worcester</option>
                    <option>Springfield</option>
                    <option>Lowell</option>
                    <option>Cambridge</option>
                </optgroup>
                <optgroup label="Michigan">
                    <option>Detroit</option>
                    <option>Grand Rapids</option>
                    <option>Warren</option>
                    <option>Sterling Heights</option>
                    <option>Lansing</option>
                </optgroup>
            </select>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //shop locator (popup) -->

    <!-- modals -->
    <!-- log in -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="email" required>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" value="Đăng nhập">
                        </div>
                    </form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="" class="btn btn-primary pt-2 pb-2 rounded-0">Đăng nhập bằng Facebook</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger pt-2 pb-2 rounded-0">Đăng nhập bằng Google </a>
                            </div>
                        </div>
                        <div class="sub-w3l">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                <label class="custom-control-label" for="customControlAutosizing">Nhớ mật khẩu?</label>
                            </div>
                        </div>
                        <p class="text-center dont-do mt-3">Bạn quên mật khẩu? Vui lòng bấm
                            <a href="{{ route('forget_password') }}">vào đây</a>
                        </p>
                        <p class="text-center dont-do mt-3">Bạn chưa có tài khoản ?
                            <a href="#" data-toggle="modal" data-target="#exampleModal2">
                                Đăng ký</a>
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!-- register -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng ký</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ và tên" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Địa chỉ email</label>
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" id="password1">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="confirm_password" id="password2">
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control register" value="Đăng Ký">
                        </div>
                        <div class="sub-w3l">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input dieukhoan" id="customControlAutosizing2">
                                <label class="custom-control-label" for="customControlAutosizing2">Đồng ý với <a href="#">điều khoản</a> của chúng tôi</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //modal -->
    <!-- //top-header -->

    <!-- header-bottom-->
    <div class="header-bot">
        <div class="container">
            <div class="row header-bot_inner_wthreeinfo_header_mid">
                <!-- logo -->
                <div class="col-md-3 logo_agile">
                    <h1 class="text-center">
                        <a href="{{ url('/') }}" class="font-weight-bold font-italic">
                            <img src="assets/client/images/logo2.png" alt=" " class="img-fluid">Electro Store
                        </a>
                    </h1>
                </div>
                <!-- //logo -->
                <!-- header-bot -->
                <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                    <div class="row">
                        <!-- search -->
                        <div class="col-10 agileits_search">
                            <form class="form-inline" action="#" method="post">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
                                <button class="btn my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                        <!-- //search -->
                        <!-- cart details -->
                        <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                                <a href="{{ route('cart_detail.index') }}" class="btn w3view-cart" title="Đang có {{ Cart::count() }} sản phẩm trong giỏ hàng">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <span class="count_cart">{{ Cart::count() }}</span>
                                </a>
                            </div>
                        </div>
                        <!-- //cart details -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop locator (popup) -->
    <!-- //header-bottom -->