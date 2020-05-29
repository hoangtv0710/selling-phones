<div class="navbar-inner">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto text-center mr-xl-5">
                        <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                            <a class="nav-link" href="{{ url('/') }}">Trang chủ
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @foreach ($category as $cate)
                            <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $cate->name }}
                                </a>
                                @if(count($cate->productType) > 0)
                                    <div class="dropdown-menu">
                                        @foreach($cate->productType as $pro_type)
                                            <a class="dropdown-item" href="product.html">{{ $pro_type->name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>