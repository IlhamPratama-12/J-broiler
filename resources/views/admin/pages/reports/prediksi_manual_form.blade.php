@extends('admin.includes.master', ['title' => 'Prediksi Keuntungan', 'page' => 'prediksi_bulan'])

@section('content')
<div class="container-fluid mt-4">
    <h4>Pilih Bulan yang Ingin Diprediksi</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('prediksi.process') }}">
        @csrf
        <div class="form-group">
            <label for="bulan_prediksi">Bulan Prediksi (Bulan-Tahun)</label>
            <select name="bulan_prediksi" class="form-control" required>
                <option value="">-- Pilih Bulan --</option>
                @foreach ($months as $month)
                    <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Prediksi</button>
    </form>
</div>
@endsection
