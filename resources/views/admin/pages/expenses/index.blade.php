@extends('admin.includes.master', ['title' => 'Pengeluaran', 'page' => 'expenses'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card-header p-0 mb-3" style="border-bottom: unset">
                    <div class="col-md-3 p-0">
                        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Pengeluaran
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tercatat</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Biaya</th>
                                    <th>Total</th>
                                    <th>Catatan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $expense->company->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($expense->date)) }}</td>
                                        <td>{{ optional($expense->type)->name }}</td>
                                        <td>{{ 'Rp ' . number_format($expense->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $expense->notes }}</td>
                                        <td>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                class="btn btn-success"
                                                href="{{ route('expenses.edit', $expense->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                onclick="destroy(event,{{ $expense->id }},`{{ $expense->company->name }}`)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">Data pengeluaran kosong.</td>
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
        let message = `{{ Session::get('success') }}`;
        if (message) {
            toastr.success(message)
        }
        $('#dataTables').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });

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
                html: `<p>Apakah anda yakin akan menghapus pengeluaran <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `expenses/${id}`,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message)
                            setTimeout(() => {
                                location.reload();
                            }, 200);
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
