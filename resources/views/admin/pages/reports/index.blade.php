@extends('admin.includes.master', ['title' => 'Laporan - Penjualan Produk', 'page' => 'product-report'])

@section('content')
    <div class="container-fluid">
        <form action="{{ route('report.product') }}" method="GET">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="mb-2">
                        <label>Pencarian</label>
                        <input type="search" name="keyword" value="{{ request()->get('keyword') }}" class="form-control" placeholder="Pencarian">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="mb-2">
                        <label>Partnerships</label>
                        <select class="form-control" style="width: 100%;" id="partnerships" name="partnership_id">
                            <option disabled selected value="">Pilih Partner</option>
                            @foreach ($partnerships as $partner)
                                <option value="{{ $partner->id }}" {{ request()->get('partnership_id') == $partner->id ? 'selected':'' }} >{{ $partner->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="mb-2">
                        <label>Perusahaan</label>
                        <select class="form-control" style="width: 100%;" id="companies" name="company_id">
                            <option value="">Pilih Perusahaan</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ request()->get('company_id') == $company->id ? 'selected':'' }} >{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4">
                    <div class="mb-2">
                        <label>Tanggal Awal</label>
                        <div class="input-group date" id="startDate" data-target-input="nearest">
                            <input type="text"
                                inputmode="numeric"
                                name="date_start"
                                class="form-control datetimepicker-input"
                                data-target="#startDate"
                                placeholder="Hari/Bulan/Tahun"
                                value="{{ request()->get('date_start') ?? '' }}"
                                />
                            <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        {{-- <input type="text" class="form-control" name="date_start" value="{{ request()->get('date_start') ?? '' }}" placeholder="Hari/Bulan/Tahun"> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4">
                    <div class="mb-2">
                        <label>Tanggal Akhir</label>
                        <div class="input-group date" id="endDate" data-target-input="nearest">
                            <input type="text"
                                inputmode="numeric"
                                name="date_end"
                                class="form-control datetimepicker-input"
                                data-target="#endDate"
                                placeholder="Hari/Bulan/Tahun"
                                value="{{ request()->get('date_end') ?? '' }}"
                                />
                            <div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        {{-- <input type="text" class="form-control" name="date_end" value="{{ request()->get('date_end') ?? '' }}" placeholder="Hari/Bulan/Tahun"> --}}
                    </div>
                </div>
                <div style="width: 6rem; padding-left:7.5px" class="mr-2">
                    <label class="d-none d-sm-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search fa-fw"></i> Cari
                    </button>
                </div>

                <div style="width: 6rem">
                    <label class="d-none d-sm-block">&nbsp;</label>
                    <a class="btn btn-secondary btn-block" href="{{route('report.product.print') . str_replace(Request::url(), '', Request::fullUrl())}}" target="_blank">
                        <i class="fas fa-print fa-fw"></i> Print
                    </a>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="10%">Tanggal</th>
                                    <th width="15%">Partner</th>
                                    <th>Produk</th>
                                    <th width="20%">Qty</th>
                                    <th width="10%">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($report as $key => $data)
                                    <tr>
                                        <td>{{ ($report->currentPage()-1) * $report->perPage() + $key + 1 }}</td>
                                        <td>{{ date('d/m/Y', strtotime($data->date)) }}</td>
                                        <td>{{ $data->partner }}</td>
                                        <td>{{ $data->product_name }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>{{ $data->unit }}</td>
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
                        {!! $report->links('vendor.pagination.bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#partnerships').select2({
                placeholder: 'Pilih Mitra',
                allowClear:true,
            })
            $('#companies').select2({
                placeholder: 'Pilih Perusahaan',
                allowClear:true,
            })

            $('#startDate').datetimepicker({
                format: 'DD/MM/Y',
            });
            $('#endDate').datetimepicker({
                format: 'DD/MM/Y',
            });
        });
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
