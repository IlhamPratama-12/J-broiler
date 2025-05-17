@extends('admin.includes.master', ['title' => 'Jenis Biaya', 'page' => 'expense-types'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-6 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="mode">Tambah</h3>
                    </div>
                    <form id="form-input">
                        <div class="card-body pb-0">
                            <div class="form-group">
                                <label for="expenseName">Nama</label>
                                <input type="text" class="form-control" name="name" id="expenseName" placeholder="Masukan Nama Biaya" oninput="checkInput(this.value)">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-1" id="btn-submit">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-danger" id="btn-cancel" onclick="cancel()" >Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive" style="width:100%">
                        <table class="table table-border table-hover" id="expense-types-list">
                            <thead>
                                <tr>
                                    <th width="70%">Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expenseTypes as $type)
                                    <tr>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <button class="btn btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"  onclick="edit({{ $type->id }},`{{ $type->name }}`)">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                class="btn-del btn btn-danger"
                                                data-key="{{ $type->id }}"
                                                data-title="{{ $type->name }} ">
                                                <i class="fas fa-trash"></i>
                                            </a>
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

        $( document ).ready(function() {
            $('#btn-cancel').hide();
        });

        let url = `expense-types`;
        let method = "POST"

        $('#form-input').on('submit', function(event) {
            event.preventDefault();
            validation()
            let data = $(this).serialize();
            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: data,
                success: function(response) {
                    $('form').trigger("reset");
                    // let expense = response.data;
                    toastr.success(response.message)
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                },

                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    toastr.error(err.name[0])
                    console.log(err);
                }
            });
        });

        const validation = () =>{
            let name = $('input#expenseName');
            let error = $('#error-message').html()
            if (name.val() == "" || !name.val()){
                name.addClass("is-invalid")
                console.log(error);
                if (!error) {
                    name.after('<span class="text-danger" id="error-message" style="font-size: 12px;">Nama tidak boleh kosong</span>')
                }
            }
        }
        const checkInput = (val) =>{
            let name = $('input#expenseName');
            if (val != ""){
                name.removeClass("is-invalid")
                $('#error-message').remove();
            }
        }

        const edit = (id, val) => {
            url = `expense-types/${id}`;
            method = "PUT";
            $('#mode').text('Edit');
            $('#btn-submit').html('<i class="fas fa-pencil-alt mr-2"></i>Edit');
            $('#expenseName').val(val);
            $("#expenseName").focus();
            $('#btn-cancel').show();
        }

        const cancel = () => {
            $('form').trigger("reset");
            $("#expenseName").blur();
            url = `expense-types`;
            method = "POST";
            $('#mode').text('Tambah');
            $('#btn-submit').html('<i class="fas fa-save mr-2"></i>Simpan');
            $('#btn-cancel').hide();
        }

        $('a.btn-del').each(function(index, btn) {
            $(btn).click(function(e) {
                const key = $(btn).attr('data-key');
                const title = $(btn).attr('data-title');
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Hapus?',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    showCancelButton: true,
                    html: `<p>Apakah anda yakin akan menghapus Tipe Biaya <strong>${title}</strong>?</p>`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `expense-types/${key}`,
                            method: "DELETE",
                            headers: {
                                'X-CSRF-Token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                toastr.success(response.message)
                                setTimeout(() => {
                                    $(this).parents('tr').remove();
                                    location.reload();
                                }, 800);
                            },
                            error: function(xhr, status, error) {
                                var err = JSON.parse(xhr.responseText);
                                toastr.warning(err.message)
                                console.log(err);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
