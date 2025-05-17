@extends('main.includes.master', ['title' => 'Home'])

@push('style')
    <style>/* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            #hero-desktop{
                display: none
            }
            #hero-phone{
                display: block
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            #hero-desktop{
                display: none
            }
            #hero-phone{
                display: block
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #hero-desktop{
                display: none
            }
            #hero-phone{
                display: block
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #hero-desktop{
                display: block
            }
            #hero-phone{
                display: none
            }
        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #hero-desktop{
                display: block
            }
            #hero-phone{
                display: none
            }
        }
    </style>
@endpush
@section('content')
    <div class="site-blocks-cover" id="hero-phone">
        <div class="container-fluid p-0 position-absolute">
            <div id="hero-slide-phone" class="carousel slide" data-ride="carousel" data-bs-interval="3000">
                <ol class="carousel-indicators">
                    <li data-target="#hero-slide-phone" data-slide-to="0" class="active"></li>
                    <li data-target="#hero-slide-phone" data-slide-to="1"></li>
                    <li data-target="#hero-slide-phone" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="site-blocks-cover"
                            style="background:url('img/hero-mobile-1.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="site-blocks-cover"
                            style="background-image:url('img/hero-mobile-2.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="site-blocks-cover"
                            style="background-image:url('img/hero-mobile-3.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#hero-slide-phone" role="button" data-slide="prev" style="z-index: 1;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#hero-slide-phone" role="button" data-slide="next" style="z-index: 1;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container" style="z-index: 1" data-aos="fade-up" data-aos-delay="">
            <div class="row align-items-start align-items-md-center justify-content-end">
                <div class="col-md-5 text-center text-md-left pt-md-0" style="height: 20rem">
                    <h1 style="padding-top: 40%">FL Broiler</h1>
                    <div class="intro-text text-center text-md-left" style="padding-top: 1rem">
                        <p class="mb-4">Kami dengan bangga mempersembahkan berbagai pilihan ayam
                            broiler berkualitas tinggi yang dihasilkan dengan standar tertinggi dalam industri peternakan.
                            Dengan pengalaman dan
                            komitmen kami terhadap kualitas, kami memastikan produk-produk kami memenuhi harapan Anda dan
                            kebutuhan pasar
                        </p>
                        <p>
                            <a href="https://wa.me/message/W7RKBN2JWUHEC1" target="_blank"
                                class="btn btn-sm btn-primary">Beli Sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-blocks-cover" id="hero-desktop">
        <div class="container-fluid p-0 position-absolute">
            <div id="hero-slide" class="carousel slide" data-ride="carousel" data-bs-interval="3000">
                <ol class="carousel-indicators">
                    <li data-target="#hero-slide" data-slide-to="0" class="active"></li>
                    <li data-target="#hero-slide" data-slide-to="1"></li>
                    <li data-target="#hero-slide" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="site-blocks-cover"
                            style="background:url('img/hero-1.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="site-blocks-cover"
                            style="background-image:url('img/hero-2.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="site-blocks-cover"
                            style="background-image:url('img/hero-3.png'); background-size:cover; background-position: center;">
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#hero-slide" role="button" data-slide="prev" style="z-index: 1;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#hero-slide" role="button" data-slide="next" style="z-index: 1;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container" style="z-index: 1">
            <div class="row align-items-start align-items-md-center justify-content-end">
                <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                    <h1 class="mb-2">FL Broiler</h1>
                    <div class="intro-text text-center text-md-left">
                        <p class="mb-4">Kami dengan bangga mempersembahkan berbagai pilihan ayam
                            broiler berkualitas tinggi yang dihasilkan dengan standar tertinggi dalam industri peternakan.
                            Dengan pengalaman dan
                            komitmen kami terhadap kualitas, kami memastikan produk-produk kami memenuhi harapan Anda dan
                            kebutuhan pasar
                        </p>
                        <p>
                            <a href="https://wa.me/message/W7RKBN2JWUHEC1" target="_blank"
                                class="btn btn-sm btn-primary">Beli Sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span><i class="fa-solid fa-truck"></i></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">LAYANAN PENGIRIMAN</h2>
                        <p>Dalam pengiriman kami juga berusaha maksimal dalam proses distribusi produk kami menghadirkan
                            mitra pengiriman ayam hidup yang dapat diandalkan dan profesional.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span><i class="fa-solid fa-shield-halved"></i></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">KEAMANAN DAN KECEPATAN</h2>
                        <p>Kami siap memberikan layanan terbaik. Kami mengerti bahwa pengiriman hewan hidup memerlukan
                            perhatian khusus dan perawatan ekstra untuk memastikan kesejahteraan dan keamanannya selama
                            perjalanan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span><i class="fa-solid fa-thumbs-up"></i></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Produk Berkualitas</h2>
                        <p>Kami dengan bangga mempersembahkan berbagai pilihan ayam broiler berkualitas tinggi yang
                            dihasilkan dengan standar tertinggi dalam industri peternakan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-blocks-2 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($categories as $key => $item)
                    <div class="col-lg-6 col-md-6 col p-3">
                        <div class="card" data-aos="fade-up" data-aos-delay="">
                            @php
                                $key = $key + 1;
                                $route = 'products?category =' . $item->slug;
                            @endphp
                            <a href="{{ url($route) }}">
                                <div class="card-body">
                                    <img class="card-img-top"
                                        src="{{ isset($item->image) ? asset(Storage::url($item->image)) : 'img/defaults/category-' . $key . '.jpg' }}"
                                        alt="Card image cap">
                                </div>
                                <div class="card-body text-dark">
                                    <span class="text-uppercase">Kategori</span>
                                    <h5 class="card-title font-weight-bold">{{ $item->name }}</h5>
                                    <p class="card-text d-none d-md-block">
                                        {{ $item->description }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2 class="text-black font-weight-bold">Produk Terkini</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @foreach ($products as $item)
                            <div class="item">
                                <div class="block-4 text-center" data-aos="fade" data-aos-delay="">
                                    <figure class="block-4-image">
                                        <img src="{{ isset($item->image) ? asset(Storage::url($item->image)) : '/img/defaults/no-image.jpg' }}" alt="Image placeholder"
                                            class="img-fluid">
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a href="{{ route('main.products.detail', $item->slug) }}">{{ $item->name }}</a></h3>
                                        <p class="mb-0">{{ $item->description }}</p>
                                        {{-- <p style="color: #075FC7" class="font-weight-bold">
                                            {{ 'Rp ' . number_format($item->final_price, 0, ',', '.') }}
                                        </p> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-8 bg-light">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2 class="text-black font-weight-bold">Layanan Produk</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <img src="img/ayam-custom.jpg" alt="Image placeholder"class="img-fluid rounded">
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h2 style="color: #075FC7" class="font-bold mb-4">Produk Spesial Pesanan</h2>
                    <p>Menyediakan layanan khusus untuk kebutuhan spesifik pelanggan.Pengolahan sesuai dengan permintaan,
                        termasuk potongan tertentu, kemasan, dan persyaratan lainnya.<br>Jangan ragu untuk menghubungi tim
                        kami untuk informasi lebih lanjut atau pemesanan.</p>
                    <p><a href="https://wa.me/message/W7RKBN2JWUHEC1" target="_blank"
                            class="btn btn-primary btn-sm">Hubungi
                            Kami</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
