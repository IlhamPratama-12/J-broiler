<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                    {{-- <form action="" class="site-block-top-search">
                        <span class="icon icon-search2"></span>
                        <input type="text" class="form-control border-0" placeholder="Search">
                    </form> --}}
                </div>

                <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                    <div class="">
                        <a href="/" class="js-logo-clone" style="border:unset">
                            <img style="width: 200px; height:50px" src="{{ asset('img/defaults/logo-default.jpg') }}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                    <div class="site-top-icons">
                        <ul>
                            <li class="d-inline-block d-md-none ml-md-0">
                                <a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li class="{{ $title == 'Home' ? 'active' : ''}}">
                    <a href="/">Home</a>
                </li>
                <li class="has-children {{ $title == '' ? 'active' : ''}}">
                    <a href="{{ url('products') }}">Kategori</a>
                    <ul class="dropdown">
                        @foreach ($categories as $item)
                            @php $route = 'products?category ='.$item->slug @endphp
                            <li><a href="{{ url($route) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ $title == 'Produk' ? 'active' : ''}}"><a href="{{ url('products') }}">Katalog</a></li>
                <li class="{{ $title == 'Tentang' ? 'active' : ''}}"><a href="{{ url('about') }}">Tentang</a></li>
                <li class="{{ $title == 'Kemitraan' ? 'active' : ''}}"><a href="{{ url('partnership') }}">Kemitraan</a></li>
                <li class="{{ $title == 'Kontak' ? 'active' : ''}}"><a href="{{ url('contact') }}">Hubungi Kami</a></li>
            </ul>
        </div>
    </nav>
</header>
