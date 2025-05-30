@extends('admin.includes.master', ['title' => 'Hasil Prediksi Keuntungan', 'page' => 'prediksi_bulan'])

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <h4 class="mb-3">
      Hasil Prediksi Keuntungan untuk Bulan: 
      {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan_prediksi)->translatedFormat('F Y') }}
    </h4>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <p><strong>Rumus Regresi Linier:</strong> Y = {{ number_format($b0, 2) }} + {{ number_format($b1, 2) }} × X</p>
    <div class="alert alert-success py-2 px-30">
        <p class="mb-1"><strong>Prediksi Keuntungan:</strong><br> Rp {{ number_format($prediksi, 0, ',', '.') }} <br> </p>
        <p class="mb-0"><strong>Prediksi Qty:</strong><br> {{ $prediksi_qty }} KG </p>
    </div>
    <hr>
    <h5>Data Penjualan dan Produk Terjual 6 Bulan Sebelumnya:</h5>

    @foreach ($monthlySales as $item)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light">
                <strong>{{ \Carbon\Carbon::createFromFormat('Y-m', $item['bulan'])->translatedFormat('F Y') }}</strong>
            </div>
            <div class="card-body">
                @if (count($item['produk']) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item['produk'] as $index => $produk)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $produk->name }}</td>
                                        <td>{{ $produk->total_qty }}</td>
                                        <td>Rp {{ number_format($produk->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Tidak ada produk terjual pada bulan ini.</p>
                @endif

                <div class="mt-2 text-end">
                    <strong>Total Penjualan:</strong> Rp {{ number_format($item['total'], 0, ',', '.') }}
                </div>
            </div>
        </div>
    @endforeach

    <div class="mt-4">
        <a href="{{ route('prediksi.form') }}" class="btn btn-secondary">← Kembali ke Form Prediksi</a>
    </div>

  </div>
</div>
@endsection
