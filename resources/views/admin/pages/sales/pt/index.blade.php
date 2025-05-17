@extends('admin.includes.master', ['title' => 'PT FL MANDIRI SEJAHTERA - Penjualan', 'page' => 'salesv1'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card-header p-0 mb-3" style="border-bottom: unset">
                    <div class="col-md-3 p-0">
                        <a href="{{ route('sales.create', ['company_id'=> '1']) }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah Penjualan
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10em">No</th>
                                    <th width="15%">Kode</th>
                                    <th>Tanggal</th>
                                    <th>Partnership</th>
                                    <th>Total</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->code }}</td>
                                        <td>{{ date('d/m/Y', strtotime($sale->date)) }}</td>
                                        <td>{{ optional($sale->partnership)->full_name }}</td>
                                        <td>{{ 'Rp ' . number_format($sale->total, 0, ',', '.') }}</td>
                                        <td>{{ optional($sale->payment)->display_name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $sale->status == 'ACTIVE'  ? 'primary' : ($sale->status == 'PENDING' ? 'success' : 'danger') }}">
                                                {{ $sale->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if ($sale->status != 'CANCEL')
                                                    <a class="btn btn-secondary dropdown-toggle" href="#"
                                                        role="button" id="dropdownPrint" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-print" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <div class="dropdown-menu" aria-labelledby="dropdownPrint">
                                                    <form action="{{ route('sale.print', $sale->id) }}" method="GET" target="_blank" id="print_travel">
                                                        <input type="hidden" name="type" value="TRAVEL">
                                                        <input type="hidden" name="company_id" value="1">
                                                        <button type="submit" class="dropdown-item">Surat Jalan</button>
                                                    </form>
                                                    <form action="{{ route('sale.print', $sale->id) }}" method="GET" target="_blank" id="print_invoice">
                                                        <input type="hidden" name="type" value="INVOICE">
                                                        <input type="hidden" name="company_id" value="1">
                                                        <button type="submit" class="dropdown-item">Invoice</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <form class="d-inline" action="{{ route('sales.show', $sale->id) }}" method="get">
                                                <input type="hidden" name="company_id" value="1">
                                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat"
                                                    class="btn btn-info">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </form>
                                            @if ($sale->status != 'CANCEL')
                                                <form class="d-inline" action="{{ route('sales.edit', $sale->id) }}" method="get">
                                                    <input type="hidden" name="company_id" value="1">
                                                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                        class="btn btn-success">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                </form>
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="CANCEL"
                                                    class="btn-del btn btn-danger"
                                                    onclick="cancel(event,`{{ $sale->id }}`,`{{ $sale->code }}`)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                            @if ($sale->status == 'CANCEL')
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    class="btn-del btn btn-danger"
                                                    onclick="destroy(event,{{ $sale->id }},`{{ $sale->code }}`)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">Data penjualan kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#dataTables').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });

        const cancel = (e,id, name) => {
            e.preventDefault();
            const key = id;
            const title = name;
            Swal.fire({
                title: 'Batalkan Penjualan?',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                html: `<p>Apakah anda yakin akan membatalkan pengjualan <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `sales/${id}/cancel`,
                        method: "POST",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message)
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            var err = JSON.parse(xhr.responseText);
                            console.log(err);
                        }
                    });
                }
            });
        }

        const destroy = (e,id, name) => {
            e.preventDefault();
            const key = id;
            const title = name;
            Swal.fire({
                title: 'Konfirmasi Hapus?',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                html: `<p>Apakah anda yakin akan menghapus pengjualan <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `sales/${id}`,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message)
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            var err = JSON.parse(xhr.responseText);
                            console.log(err);
                        }
                    });
                }
            });
        }
    </script>
@endpush
