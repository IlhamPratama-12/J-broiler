<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{  $company->name." | ". $type }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/adminLTE/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLTE/css/adminlte.min.css') }}">
</head>

<body>
    <div class="wrapper">
        <section class="invoice" style="border: unset">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        @if ($type == 'Invoice')
                            <i class="fas fa-shopping-cart mr-2"></i>
                        @else
                            <i class="fas fa-truck mr-2"></i>
                        @endif
                        {{ $type }}
                        <small class="float-right">Tanggal Invoice : {{ date('d/m/Y', strtotime($sale->date))}}</small>
                    </h2>
                </div>
            </div>

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Pengirim :</b>
                    <address>
                        <strong>Admin, {{ $company->name }}</strong><br>
                        Phone: {{ $company->phone  }}<br>
                        Alamat: {{ $company->address }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Kepada :</b>
                    <address>
                        <strong>{{ optional($sale->partnership)->full_name ?? "" }}</strong><br>
                        {{ "Phone: " . optional($sale->partnership)->phone ?? "" }}<br>
                        {{ "Alamat: ". optional($sale->partnership)->business_address ?? "" }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice : {{ $sale->code }}</b><br>
                    <b>Status : {{ $sale->status }}</b><br>
                </div>
            </div>

            <div class="row">
                <div class="{{ $type == 'Invoice' ? 'col-12' : 'col-6' }} table-responsive ">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                @if ($type == "Invoice" && $company->id == 1)
                                <th class="text-right">Harga</th>
                                <th class="text-right">Subtotal</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetails as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="padding:8px;vertical-align: unset">
                                        {{ $item->product->name }}
                                    </td>
                                    <td style="vertical-align: unset">
                                        {{ $item->qty }}
                                    </td>
                                    <td style="vertical-align: unset">
                                        {{ $item->product->unit ?? ''}}
                                    </td>
                                    @if ($type == "Invoice" && $company->id == 1)
                                        <td class="text-right" style="vertical-align: unset">
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right" style="vertical-align: unset">
                                            <label class="font-weight-normal">
                                                {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </label>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="{{ $type == "Invoice" ? 'd-none' : 'col-6' }}">
                    <p class="lead ml-4 mb-0">Perhatian:</p>
                    <ol class="text-muted well well-sm shadow-none">
                        <li >Surat Jalan ini merupakan bukti resmi penerimaan barang</li>
                        <li>Surat Jalan ini bukan bukti penjualan </li>
                        <li>Surat Jalan ini akan dilengkapi invoice sebagai bukti penjualan</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <p class="lead">Catatan:</p>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px; height:2rem ">
                        {{ $sale->notes }}
                    </p>
                </div>
                @if ($type == "Invoice" && $company->id == 1)
                    <div class="col-6">
                        <div class="flex">
                            <table class="table table-sm table-borderless text-right" >
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td>{{ number_format($sale->total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Metod Pembayaran:</th>
                                    <td>{{ optional($sale->payment)->display_name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between text-center">
                        <div class="col-4">
                            <h6> Tanda Terima,</h6>
                            <div style="width: 100%;height:5rem" class=" img-fluid d-flex justify-content-center align-items-center">

                            </div>
                            <h6 class="border-bottom">&nbsp;</h6>
                        </div>
                        <div class="col-4">
                            <h6> Hormat Kami,</h6>
                            <div style="width: 100%;height:5rem" class=" img-fluid d-flex justify-content-center align-items-center">

                            </div>
                            <h6 class="border-bottom">&nbsp;</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        let company = {!! isset($company) ? json_encode($company) : null !!};
        let sale = {!! isset($sale) ? json_encode($sale) : null !!};
        window.addEventListener("load", (event) => {
            document.title=`${company.name}-${sale.code}`
            window.print()
        });
    </script>
</body>

</html>
