@extends('admin.includes.master', ['title' => $title, 'page' => 'guests'])

@section('content')
    <div class="container-fluid">
        <form action="{{ $route }}" method="POST">
            @csrf
            @if (isset($guest->id))
                @method('PUT')
            @endif
            <a href="{{ route('guests.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i>
                Kembali</a>
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Tamu</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fullName" class="required">Nama Lengkap</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="fullName" name="full_name" value="{{ $guest->full_name ?? old('full_name') }}" placeholder="Nama Lengkap">
                                @if ($errors->has('full_name'))
                                    <span class="error invalid-feedback">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone" class="required">Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $guest->phone ?? old('phone') }}" placeholder="Nama" onkeypress="return isNumber(event)">
                                @if ($errors->has('phone'))
                                    <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="message">Diskrisi</label>
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Pesan">{{ $guest->message ?? old('message') }}</textarea>
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
        const isNumber = (evt) => {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush
