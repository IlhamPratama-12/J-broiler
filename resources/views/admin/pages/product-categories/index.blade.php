@extends('admin.includes.master', ['title' => 'Kategori', 'page' => 'product-categories'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card-header p-0 mb-3" style="border-bottom: unset">
                    <a href="{{ route('product-categories.create') }}" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Tambah Kategori</a>
                </div>
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-border table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="2em">No</th>
                                    <th>Name</th>
                                    <th width="50%">Diskripsi</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productCategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <form class="d-inline" action="{{ route('category.isvisible', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Tampilkan/Sembunyikan" class="btn btn-light">
                                                    <i class="fas fa-eye{{ $category->is_visible ? '' : '-slash' }}"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"
                                                href="{{ route('product-categories.edit', $category->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                onclick="destroy(event,{{ $category->id }},`{{ $category->name }}`)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">There are no categories.</td>
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
                html: `<p>Apakah anda yakin akan menghapus Kategori <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `product-categories/${id}`,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.success)
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
