@extends('main.includes.master', ["title" => "Detail Produk"])

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('main.home') }}">Home</a><span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Detail Produk</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ isset($product->image) ? asset(Storage::url($product->image)) : '/img/defaults/no-image.jpg' }}"
                        alt="Image" class="img-fluid" style="max-width: 20rem">
                </div>
                <div class="col-md-6">
                    <h3 class="text-black">{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="mb-4">{{ $product->notes }}</p>
                    {{-- <p><strong class="text-primary h4">{{ 'Rp '. number_format($product->final_price,  0, ",", '.') }}</strong></p> --}}
                    {{-- <div class="mb-1 d-flex">
                        <label for="option-sm" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                    id="option-sm" name="shop-sizes"></span> <span
                                class="d-inline-block text-black">Small</span>
                        </label>
                        <label for="option-md" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                    id="option-md" name="shop-sizes"></span> <span
                                class="d-inline-block text-black">Medium</span>
                        </label>
                        <label for="option-lg" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                    id="option-lg" name="shop-sizes"></span> <span
                                class="d-inline-block text-black">Large</span>
                        </label>
                        <label for="option-xl" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                    id="option-xl" name="shop-sizes"></span> <span class="d-inline-block text-black"> Extra
                                Large</span>
                        </label>
                    </div> --}}
                    {{-- <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="1" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div> --}}
                    <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Beli Sekarang</a></p>

                </div>
            </div>
        </div>
    </div>
@endsection
