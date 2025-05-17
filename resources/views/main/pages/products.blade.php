@extends('main.includes.master', ["title" => "Produk"])

@push('style')
    <style>
        .pagination{
            justify-content: center
        }

    </style>
@endpush
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Katalog</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-9 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Semua Produk</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Terbaru
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                        <a class="dropdown-item" href="{{ url('products?old=true') }}">Terlama</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuReference" data-toggle="dropdown">Urutkan</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="{{ url('products?asc=true') }}">Nama, A sampai Z</a>
                                        <a class="dropdown-item" href="{{ url('products?desc=true') }}">Nama, Z sampai A</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('products?low=true') }}">Harga, Rendah ke Tinggi</a>
                                        <a class="dropdown-item" href="{{ url('products?high=true') }}">Harga, Tinggi ke Rendah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        @forelse ($products as $item)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <figure class="block-4-image">
                                        <a href="{{ route('main.products.detail', $item->slug) }}">
                                            <img src="{{ isset($item->image) ? asset(Storage::url($item->image)) : '/img/defaults/no-image.jpg' }}" alt="Image placeholder" class="img-fluid" style="max-width: 15rem">
                                        </a>
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a href="{{ route('main.products.detail', $item->slug) }}">{{ $item->name }}</a></h3>
                                        <p class="mb-0">{{ $item->description }}</p>
                                        {{-- <p class="text-primary font-weight-bold">{{ 'Rp '. number_format($item->final_price,  0, ",", '.') }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-sm-12 text-center" data-aos="fade-up">
                            <h3>Data Kosong</h3>
                        </div>
                        @endforelse
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            <div class="">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
                        <ul class="list-unstyled mb-0">
                            @foreach ($categories as $item)
                                @php $route = 'products?category ='.$item->slug @endphp
                                <li class="mb-1">
                                    <a href="{{ url($route) }}" class="d-flex"><span>{{ $item->name }}</span>
                                    <span class="text-black ml-auto">({{ $item->products->count() }})</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
