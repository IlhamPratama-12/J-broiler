@extends('admin.includes.master', ['title' => $title, "page" => "partnerships"])

@section('content')
    <div class="container-fluid">
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($partnership->id))
                @method('PUT')
            @endif

            <a href="{{ route('partnerships.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-3">
                <div class="col-md-12 col-lg-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori"><span class="text-danger">*</span>Tipe</label>
                                <select class="form-control  @error('type') is-invalid @enderror" name="type" id="kategori">
                                    <option disabled selected >Pilih Kategori</option>
                                    <option value="MITRA"
                                        {{ old('type') ? 'selected' : '' }}
                                        {{ ($partnership->type == "MITRA" ? 'selected' : '') }}>MITRA</option>
                                    <option value="CUSTOMER"
                                        {{ old('type') ? 'selected' : '' }}
                                        {{ ($partnership->type == "CUSTOMER" ? 'selected' : '') }}>PELANGGAN</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="error invalid-feedback">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="fullName"><span class="text-danger">*</span>Nama Lengkap</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="fullName" name="full_name" value="{{ old('full_name', $partnership->full_name ?? '') }}" placeholder="Nama Lengkap">
                                @if ($errors->has('full_name'))
                                    <span class="error invalid-feedback">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone"><span class="text-danger">*</span>Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $partnership->phone ?? '') }}" placeholder="Telepon"  onkeypress="return isNumber(event)">
                                @if ($errors->has('phone'))
                                    <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="bisnis">Nama Bisnis</label>
                                <input type="text" class="form-control" id="bisnis" name="business_name" value="{{ old('business_name', $partnership->business_name ?? '') }}" placeholder="Nama Bisnis">
                            </div>
                            <div class="form-group">
                                <label for="business_address">Alamat Bisnis</label>
                                <textarea class="form-control" id="business_address" name="business_address" rows="3" placeholder="Alamat">{{ old('business_address', $partnership->business_address ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bisnis">Sosial Media(Optional)</label>
                                <input type="text" class="form-control" id="bisnis" name="sosial_media" value="{{ old('name', $partnership->name ?? '') }}" placeholder="Nama Bisnis">
                            </div>
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Catatan">{{ old('notes', $partnership->notes ?? '') }}</textarea>
                            </div>
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
        const isNumber = (e) => {
            e = (e) ? e : window.event;
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush
