@extends('admin.includes.master', ['title' => 'Partnership', 'page' => 'partnerships'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card-header p-0 mb-3" style="border-bottom: unset">
                    <a href="{{ route('partnerships.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah
                        Partner</a>
                </div>
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10em">No</th>
                                    <th>Type</th>
                                    <th width="25%">Nama Lengkap</th>
                                    <th>Telepon</th>
                                    <th>Nama Bisnis/Usaha</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partnerships as $partner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $partner->type == 'MITRA' ? 'primary' : 'warning' }}">
                                                {{ $partner->type }}
                                            </span>
                                        </td>
                                        <td>{{ $partner->full_name }}</td>
                                        <td>{{ $partner->phone }}</td>
                                        <td>{{ $partner->business_name }}</td>
                                        <td>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat"
                                                class="btn btn-info"
                                                href="{{ route('partnerships.show', $partner->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                class="btn btn-success"
                                                href="{{ route('partnerships.edit', $partner->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                onclick="destroy(event,{{ $partner->id }},`{{ $partner->full_name }}`)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">Data Kosong.</td>
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
                html: `<p>Apakah anda yakin akan menghapus <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `partnerships/${id}`,
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
