@extends('admin.includes.master', ['title' => $title, 'page' => 'products'])

@section('content')
    <div class="container-fluid">
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product->id))
                @method('PUT')
            @endif

            <a href="{{ route('products.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Produk</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-control" name="product_category_id" id="kategori">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('product_category_id') ? 'selected' : '' }}
                                            {{ isset($product->product_category_id) ? ($category->id == $product->product_category_id ? 'selected' : '') : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama"><span class="text-danger">*</span>Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="nama" name="name" value="{{ old('name', $product->name ?? '') }}"
                                    placeholder="Nama">
                                @if ($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="diskripsi">Diskrisi</label>
                                <textarea class="form-control" id="diskripsi" name="description" rows="5" placeholder="Diskripsi">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="unit">Satuan Barang</label>
                                <input type="text" class="form-control"
                                    id="unit" name="unit" value="{{ old('unit', $product->unit ?? '') }}"
                                    placeholder="pcs/kg/gram/ekor/potong">
                            </div>
                            {{-- <div
                                class="mb-2 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="isVisible" name="is_visible"
                                    {{ isset($product->is_visible) ? ($product->is_visible == true ? 'checked' : '') : 'checked' }}>
                                <label class="custom-control-label" for="isVisible">Tampilkan di Website Utama</label>
                            </div> --}}
                            <div class="form-group">
                                <div class="row">
                                    @if (isset($product->id))
                                        <div class="col-md-6">
                                            <label for="stok">Tambah Stok</label>
                                            <input type="text" class="form-control" id="stok" name="add_stock"
                                                onkeypress="return isNumber(event)" placeholder="Tambah Stok">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" id="stok" name="stock"
                                                value="{{ old('stock', $product->stock ?? '') }}"
                                                onkeypress="return isNumber(event)" placeholder="Stok">
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <label for="harga">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="price"
                                            value="{{ old('price', $product->price ?? '') }}"
                                            onkeypress="return isNumber(event)" placeholder="Harga">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Catatan">{{ old('notes', $product->notes ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Upload Gambar</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    id="formFile" name="image" onchange="loadFile(event)">
                                @if ($errors->has('image'))
                                    <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Preview Gambar</h3>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $product->image != null ? asset(Storage::url($product->image)) : asset('img/defaults/no-image.jpg') }}"
                                class="img-fluid img-thumbnail" id="preview" style="max-height: 25rem">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5"><i class="fas fa-save mr-2"></i>Submit</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        const isNumber = (evt) => {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        const loadFile = (e) => {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush
