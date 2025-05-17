@extends('admin.includes.master', ['title' => $title, 'page' => 'sales'])


@section('content')
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-warning">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </button>
        <div class="row mt-3">
            <div class="col-lg-8 col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <table>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Kode</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $sale->code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Tanggal</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ date('d/m/Y', strtotime($sale->date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Pelanggan</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $sale->partnership->full_name }}</td>
                                    </tr>
                                    @if ($sale->company_id == 1)
                                        <tr>
                                            <td class="font-weight-bold py-1 pr-2">Metode Pembayaran</td>
                                            <td class="pr-2">:</td>
                                            <td>{{ optional($sale->payment)->display_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold py-1 pr-2">Total</td>
                                            <td class="pr-2">:</td>
                                            <td>{{ 'Rp ' . number_format($sale->total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Status</td>
                                        <td class="pr-2">:</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $sale->status == 'ACTIVE'  ? 'primary' : ($sale->status == 'PENDING' ? 'success' : 'danger') }}">
                                                {{ $sale->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold py-1 pr-2">Catatan</td>
                                        <td class="pr-2">:</td>
                                        <td>{{ $sale->notes }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="dynamic_field">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="40%">Item</th>
                                                <th width="10%">Qty</th>
                                                @if ($sale->company_id == 1)
                                                    <th class="text-right">Harga</th>
                                                    <th class="text-right">Subtotal</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sale->saleDetails as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    @if ($sale->company_id == 1)
                                                        <td class="text-right">
                                                            {{ number_format($item->price, 0, ',', '.') }}</td>
                                                        <td class="text-right">
                                                            {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @if ($sale->company_id == 1)
                                            <tfoot class="thead-light">
                                                <tr>
                                                    <th colspan="3" class="text-right">Total</th>
                                                    <th class="text-right font-weight-normal" >{{ number_format($sale->total, 0, ',', '.')  }}</th>
                                                </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
