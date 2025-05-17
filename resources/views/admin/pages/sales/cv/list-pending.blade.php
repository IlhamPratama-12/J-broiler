@extends('admin.includes.master', ['title' => 'CV Dian Latippa - Penjualan Pending', 'page' => 'list-pending'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10em">No</th>
                                    <th width="15%">Kode</th>
                                    <th  width="15%">Tanggal</th>
                                    <th>Partnership</th>
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
                                        <td>
                                            <span
                                                class="badge badge-success">
                                                {{ $sale->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"
                                                class="btn-del btn btn-success"
                                                onclick="isActive(event,{{ $sale->id }},`{{ $sale->code }}`)">
                                                <i class="fas fa-check-square    "></i>
                                            </button>
                                            <div class="btn-group">
                                                <a class="btn btn-secondary dropdown-toggle" href="#"
                                                    role="button" id="dropdownPrint" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownPrint">
                                                    <form action="{{ route('sale.print', $sale->id) }}" method="GET" target="_blank" id="print_travel">
                                                        <input type="hidden" name="type" value="TRAVEL">
                                                        <input type="hidden" name="company_id" value="2">
                                                        <button type="submit" class="dropdown-item">Surat Jalan</button>
                                                    </form>
                                                    <form action="{{ route('sale.print', $sale->id) }}" method="GET" target="_blank" id="print_invoice">
                                                        <input type="hidden" name="type" value="INVOICE">
                                                        <input type="hidden" name="company_id" value="2">
                                                        <button type="submit" class="dropdown-item">Invoice</button>
                                                    </form>
                                                </div>
                                            </div>
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
                    <div class="card-footer clearfix">
                        {!! $sales->links('vendor.pagination.bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const isActive = (e,id, name) => {
            e.preventDefault();
            const key = id;
            const title = name;
            var route = "{{ route('sale.is-active', ":id") }}";
            let url = route.replace(':id', key);
            Swal.fire({
                title: 'Konfirmasi Selesai?',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                html: `<p>Apakah Penjualan <strong>${title}</strong> sudah selesai?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
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
    </script>
@endpush
