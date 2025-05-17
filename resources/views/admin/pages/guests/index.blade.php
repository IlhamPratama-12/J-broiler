@extends('admin.includes.master', ['title' => 'Tamu', 'page' => 'guests'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-border table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="2em">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Telepon</th>
                                    <th width="50%">Pesan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guests as $guest)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $guest->full_name }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td>{{ $guest->message }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-user-plus"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <form method="POST"
                                                        action="{{ route('guests.add-partnership', $guest->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="type" value="MITRA">
                                                        <button class="dropdown-item">Mitra</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('guests.add-partnership', $guest->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="type" value="CUSTOMER">
                                                        <button class="dropdown-item">Pelanggan</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <a class="btn btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"
                                                href="{{ route('guests.edit', $guest->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                onclick="destroy(event,{{ $guest->id }},`{{ $guest->full_name }}`)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">Data Tamu Kosong.</td>
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
            "ordering": false,
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
                html: `<p>Apakah anda yakin akan menghapus tamu <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `guests/${id}`,
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
