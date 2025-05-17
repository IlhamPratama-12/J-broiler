@extends('admin.includes.master', ['title' => 'Produk', 'page' => 'products'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card-header p-0 mb-3" style="border-bottom: unset">
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah
                        Produk</a>
                </div>
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10em">No</th>
                                    <th width="30%">Nama</th>
                                    {{-- <th>Total Stok</th> --}}
                                    <th>Terjual</th>
                                    <th>Sisa Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        {{-- <td>{{ $product->stock }}</td> --}}
                                        <td>{{ optional($product->stockView)->terjual }}</td>
                                        <td>
                                            <span
                                                class="font-weight-normal badge badge-{{ optional($product->stockView)->sisa <= 10 ? 'danger' : '' }}"
                                                style="font-size: 100%">
                                                {{ optional($product->stockView)->sisa ?? 'Kosong' }}
                                            </span>
                                        </td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ isset($product->price) ? number_format($product->price, 0, ',', '.') : '' }}
                                        </td>
                                        <td>
                                            <form class="d-inline" action="{{ route('products.isvisible', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Tampilkan/Sembunyikan" class="btn btn-light">
                                                    <i class="fas fa-eye{{ $product->is_visible ? '' : '-slash' }}"></i>
                                                </button>
                                            </form>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"
                                                class="btn btn-info"
                                                href="{{ route('products.show', $product->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                class="btn btn-success"
                                                href="{{ route('products.edit', $product->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                onclick="destroy(event,{{ $product->id }},`{{ $product->name }}`)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">Tidak ada produk.</td>
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
            const key = id;
            const title = name;
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus?',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                html: `<p>Apakah anda yakin akan menghapus Produk <strong>${title}</strong>?</p>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `products/${id}`,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.success)
                            setTimeout(() => {
                                location.reload();
                            }, 800);
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
