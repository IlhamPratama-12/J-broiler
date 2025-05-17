@extends('admin.includes.master', ['title' => $title, "page" => "products"])


@section('content')
    <div class="container-fluid">
        <a href="{{ route('products.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                    <img src="{{ isset($product->image) ? asset(Storage::url($product->image)) : asset('img/defaults/no-image.jpg') }}" class="img-fluid img-thumbnail" id="preview" style="max-height: 25rem" >
                            </div>
                            <div class="col-md-12 col-lg-8">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Kategori</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ optional($product->category)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Nama</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Deskripsi</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Satuan Barang</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->unit }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Stok</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Harga</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Status Di Website</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->is_visible ? 'DiTampil' : 'Disembunyikan' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Catatan</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $product->notes }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
