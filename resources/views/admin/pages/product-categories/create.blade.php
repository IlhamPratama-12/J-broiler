@extends('admin.includes.master', ['title' => $title, 'page' => 'product-categories'])

@section('content')
    <div class="container-fluid">
        {{-- {{ dd($category->products->count()) }} --}}
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($category->id))
                @method('PUT')
            @endif
            <a href="{{ route('product-categories.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Input Kategori</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama"><span class="text-danger">*</span>Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="name" value="{{ $category->name ?? old('name') }}" placeholder="Nama">
                                    @if ($errors->has('name'))
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="diskripsi">Diskrisi</label>
                                    <textarea class="form-control" id="diskripsi" name="description" rows="6" placeholder="Diskripsi">{{ $category->description ?? old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="formFile" class="form-label"><span
                                        class="text-danger">*</span>Upload Gambar</label>
                                    <input class="form-control @error('image') is-invalid @enderror " type="file" id="formFile" name="image" onchange="loadFile(event)">
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
                                <img src="{{ isset($category->image) ? asset(Storage::url($category->image)) : asset('/img/defaults/no-image.jpg') }}" class="img-fluid img-thumbnail" id="preview" style="max-height: 22rem" >
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
