@extends('admin.includes.master', ['title' => $title, 'page' => 'sales'])

@push('style')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <a href="{{ route('sales.index', ['company_id' => '1']) }}" class="btn btn-warning">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <form id="pt-store">
            <input type="hidden" name="company_id" value="" />
            <input type="hidden" name="status" value="ACTIVE" />
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="nama"><span class="text-danger">*</span>Tanggal</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            name="date" id="datepicker" value="" placeholder="Hari-Bulan-Tahun">
                                        @if ($errors->has('date'))
                                            <span class="error invalid-feedback">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="partnerships"><span class="text-danger">*</span>Pelanggan</label>
                                        <select class="form-control @error('partnership_id') is-invalid @enderror"
                                            name="partnership_id" id="partnerships" style="width: 100%;">
                                            <option disabled selected value="">Pilih Pelanggan</option>
                                            @foreach ($partnerships as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ old('partnership_id') ? 'selected' : '' }}
                                                    {{ $p->id == $sale->partnership_id ? 'selected' : '' }}>
                                                    {{ $p->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('partnership_id'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('partnership_id') }}</span>
                                        @endif
                                    </div>
                                    @if (!isset($sale->id))
                                        <div class="form-group">
                                            <label for="products">Produk</label>
                                            <div class="row">
                                                <div class="col">
                                                    <select
                                                        class="form-control @error('sale_details') is-invalid @enderror "
                                                        id="products" style="width: 100%;">
                                                        <option disabled selected value="">Cari Produk</option>
                                                        @foreach ($products as $item)
                                                            <option value="{{ $item }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="add-item" style="width: 3rem">
                                                    <div class="float-left">
                                                        <button type="button" name="add" id="add"
                                                            class="btn btn-success">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @if ($errors->has('sale_details'))
                                                    <span
                                                        class="error invalid-feedback">{{ $errors->first('sale_details') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th width="15%">Qty</th>
                                                    <th width="25%" class="text-right">Harga</th>
                                                    <th width="15%" class="text-right">Subtotal</th>
                                                    @if (!isset($sale->id))
                                                        <th width="5%"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($sale->saleDetails) && count($sale->saleDetails) > 0)
                                                    @foreach ($sale->saleDetails as $key => $item)
                                                        <tr>
                                                            <td style="padding:8px;vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][product_id]"
                                                                    value="{{ $item->product_id }}" />
                                                                {{ $item->product->name }}
                                                            </td>
                                                            <td style="vertical-align: unset">
                                                                <input type="text"
                                                                    name="sale_details[{{ $key }}][qty]"
                                                                    placeholder="Qty" id="qty_{{ $key }}"
                                                                    value="{{ $item->qty }}"
                                                                    onkeypress="return isNumber(event)"
                                                                    class="form-control form-control-sm text-right"
                                                                    onchange="countSubTotal(this.value,'qty', {{ $key }})" />
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="text"
                                                                    name="sale_details[{{ $key }}][price]"
                                                                    placeholder="Harga" id="price_{{ $key }}"
                                                                    value="{{ $item->price }}"
                                                                    onkeypress="return isNumber(event)"
                                                                    class="form-control form-control-sm text-right"
                                                                    onchange="countSubTotal(this.value,'price', {{ $key }})" />
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden" class="input-sale-details"
                                                                    name="sale_details[{{ $key }}][subtotal]"
                                                                    id="sub_total_{{ $key }}"
                                                                    value="{{ $item->subtotal }}" />
                                                                <label class="font-weight-normal"
                                                                    id="label_subtotal_{{ $key }}">
                                                                    {{ number_format($item->subtotal, 0, ',', '.') }}
                                                                </label>
                                                            </td>
                                                            @if (!isset($sale->id))
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm remove-tr"
                                                                        onclick="deleteRow('sub_total_{{ $key }}')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-right"
                                                        style="padding:8px;vertical-align: unset">Total</th>
                                                    <td class="text-right" style="padding:8px;vertical-align: unset">
                                                        <input type="hidden" name="total" id="total"
                                                            value="{{ $sale->total ?? 0 }}" />
                                                        <label class="col-form-label font-weight-normal" id="totalLabel">
                                                            {{ number_format($sale->total, 0, ',', '.') }}
                                                        </label>
                                                    </td>
                                                    @if (!isset($sale->id))
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between col-12 p-0">
                                    <div class="col-md-4 col">
                                        <div class="form-group">
                                            <label for="notes">Catatan</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Catatan">{{ old('notes', $sale->notes ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col">
                                        <div class="row">
                                            <label class="col-sm-12 col-md-4 col-form-label p-0 m-1" for="method">Metode
                                                Pembayaran</label>
                                            <div class="col p-0 pr-2">
                                                <select class="form-control " name="payment_method" id="method">
                                                    <option value="">Pilih</option>
                                                    @foreach ($paymentMethods as $method)
                                                        <option value="{{ $method->name }}"
                                                            {{ old('payment_method_id') ? 'selected' : '' }}
                                                            {{ isset($sale->payment_method) ? ($sale->payment_method == $method->name ? 'selected' : '') : '' }}>
                                                            {{ $method->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-30 mt-3">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary" id="submit">
                                                    <i class="fas fa-save mr-2"></i>Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-response" tabindex="-1" role="dialog" show
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ringkasan Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td style="width: 5em"><label>Tanggal</label></td>
                            <td style="width: 1em"><label> :</label></td>
                            <td><label class="font-weight-normal" id="date_sale">19/09/2023</label></td>
                        </tr>
                        <tr>
                            <td><label>Kode</label></td>
                            <td><label>:</label></td>
                            <td><label class="font-weight-normal" id="code_sale">QWERTYQ123</label></td>
                        </tr>
                        <tr>
                            <td><label>Pembeli</label></td>
                            <td><label>:</label></td>
                            <td> <label class="font-weight-normal" id="customer_sale">ARIF</label></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" id="table-repsonse">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th width="10%">Qty</th>
                                <th width="8%">Satuan</th>
                                <th width="15%" class="text-right">Harga</th>
                                <th width="15%" class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-center align-items-center">
                    <div class="btn-group">
                        <a class="btn btn-secondary dropdown-toggle" href="#"
                            role="button" id="dropdownPrint" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-print mr-2" aria-hidden="true"></i>Print
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownPrint">
                            <form action="" method="GET" target="_blank" id="print_travel">
                                <input type="hidden" name="type" value="TRAVEL">
                                <input type="hidden" name="company_id" value="1">
                                <button type="submit" class="dropdown-item">Surat Jalan</button>
                            </form>
                            <form action="" method="GET" target="_blank" id="print_invoice">
                                <input type="hidden" name="type" value="INVOICE">
                                <input type="hidden" name="company_id" value="1">
                                <button type="submit" class="dropdown-item">Invoice</button>
                            </form>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        const isNumber = (evt) => {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        const formatNumericDecimal = (value, alwaysDecimal = false) => {
            let floor = Math.floor(value);
            return Intl.NumberFormat("id-ID", {
                style: "decimal",
                maximumFractionDigits: (!alwaysDecimal) && (floor == value) ? 0 : 2,
            }).format(value);
        }

        const formatDisplayDate = (dateString) => {
            let formatted = '';
            if (dateString != null && dateString != '') {
                let date = new Date(dateString);
                formatted = date.toLocaleDateString('id-ID', {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric", // numeric=2012, 2-digit=12
                });
            }
            return formatted;
        };

        $(document).ready(function() {
            //SET COMPANY ID
            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('company_id');
            $('input[name=company_id]').val(myParam);

            // SET VALUE DATE NOW
            let now = new Date()
            if (sale.date != null) now = new Date(sale.date)
            document.getElementById('datepicker').valueAsDate = now

            let error = `{{ Session::get('errors') }}`;
            if (error) {
                toastr.error("Data Gagal Disimpan")
                $("#partnerships").val('').trigger("change");
                $("#products").val('').trigger("change");
            }
            $('#partnerships').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Pelanggan",
            })
            $('#products').select2({
                theme: 'bootstrap4',
                placeholder: "Cari Produk",
            })
        });

        let sale = {!! isset($sale) ? json_encode($sale) : null !!};
        let saleDetails = {!! isset($sale) ? json_encode($sale->saleDetails) : '[]' !!};
        var i = (saleDetails.length > 0) ? saleDetails.length : 0;

        $("#add").click(function() {
            let data = $('#products').val()
            if (!data) {
                return toastr.warning("Tidak ada data produk yg dipilih.")
            }
            let product = JSON.parse(data)

            let baseTotal = $(`#total`).val();
            let countTotal = parseInt(baseTotal) + parseInt(product.price ?? 0)
            $(`#total`).val(countTotal)
            $(`#totalLabel`).text(formatNumericDecimal(countTotal))

            let price = formatNumericDecimal(product.price)
            $("#dynamic_field").append(
                `<tr>
                    <td style="padding:8px;vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][product_id]" value="${parseInt(product.id)}"/>
                        <input type="hidden" name="sale_details[${i}][product_name]" value="${product.name}"/>
                        ${product.name}
                    </td>
                    <td style="vertical-align: unset">
                        <input type="text" name="sale_details[${i}][qty]" placeholder="Qty" id="qty_${i}" value="1" onkeypress="return isNumber(event)" class="form-control text-right" onchange="countSubTotal(this.value,'qty', ${i})"/>
                    </td>
                    <td class="text-right" style="vertical-align: unset">
                        <input type="text" name="sale_details[${i}][price]" placeholder="Harga" id="price_${i}" value="${product.price ?? 0}" onkeypress="return isNumber(event)" class="form-control text-right" onchange="countSubTotal(this.value,'price', ${i})"/>
                    </td>
                    <td class="text-right td_subtotal" style="vertical-align: unset" >
                        <input type="hidden" class="input-sale-details" name="sale_details[${i}][subtotal]" id="sub_total_${i}" value="${product.price ?? 0}" />
                        <label class="font-weight-normal" id="label_subtotal_${i}">${price}</label>
                    </td>
                    <td>
                        <button type="button"
                            class="btn btn-danger btn-sm remove-tr" onclick="deleteRow(sub_total_${i})">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>`
            );
            i++
            $("#products").val('').trigger("change");
        });

        const deleteRow = (sub) => {
            let subtotal = sub.value
            let total = $(`#total`).val()
            let countTotal = parseInt(total) - parseInt(subtotal)
            $(`#total`).val(countTotal)
            $(`#totalLabel`).text(formatNumericDecimal(countTotal))
        }

        $(document).on('click', '.remove-tr', function(event) {
            $(this).parents('tr').remove();
        });

        const countSubTotal = (value, field, i) => {
            let qty = $(`input#qty_${i}`).val() ?? 0
            let price = $(`input#price_${i}`).val() ?? 0
            if (field == 'qty') {
                qty = value;
            }
            if (field == 'price') {
                price = value;
            }

            let sub_total = parseInt(qty) * parseInt(price);
            $(`input#sub_total_${i}`).val(sub_total);
            $(`#label_subtotal_${i}`).text(formatNumericDecimal(sub_total));
            countTotal()
        }

        const countTotal = () => {
            var total = 0
            var list = document.getElementsByClassName("input-sale-details");
            var values = [];
            for (var i = 0; i < list.length; ++i) {
                values.push(parseInt(list[i].value));
            }
            total = values.reduce(function(previousValue, currentValue, index, array) {
                return previousValue + currentValue;
            });
            $(`#totalLabel`).text(formatNumericDecimal(total))
            $(`#total`).val(total)
        }

        let url = `{{ route('sales.store') }}`;
        let method = "POST";
        let form = '#pt-store';
        if (sale.id) {
            url = `{{ url('admin/sales/${sale.id}') }}`;
            method = "PUT";
        }

        $('#submit').click(function(event) {
            $('.table_tr').remove();
            event.preventDefault();
            let data = $(form).serialize();
            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: data,
                success: function(response) {
                    toastr.success(response.message)
                    let res = response.data;
                    setRoutePrint(res.id)
                    setHeaderModal(`${res.date}`, `${res.code}`, `${res.partnership.full_name}`)
                    let table = $('#table-repsonse')
                    res.sale_details.forEach(v => {
                        let price = formatNumericDecimal(v.price)
                        let subtotal = formatNumericDecimal(v.subtotal)
                        table.append(
                            `<tr class="table_tr" >
                                <td style="padding:8px;vertical-align: unset">
                                    ${v.product.name}
                                </td>
                                <td style="vertical-align: unset">
                                    ${v.qty}
                                </td>
                                <td style="vertical-align: unset">
                                    ${v.product.unit ?? ''}
                                </td>
                                <td class="text-right" style="vertical-align: unset">
                                    ${price}
                                </td>
                                <td class="text-right" style="vertical-align: unset" >
                                    ${subtotal}
                                </td>
                            </tr>`)
                    });
                    $('#modal-response').modal({backdrop: 'static', keyboard: false});
                    if (sale.id == null) {
                        resetform()
                    }
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    if (err) {
                        toastr.error(err.message)
                    }
                }
            });
        });

        const resetform = () => {
            $("textarea#notes").val("");
            $('input#total').val('0');
            $("input[name^='sale_details[]']").val("");
            $('#totalLabel').text('0');
            $('#method').val('').trigger("change");
            $('#dynamic_field tbody tr').remove();
            $("#partnerships").val('').trigger("change");
            $("#products").val('').trigger("change");
        }

        const setHeaderModal = (date,code,customer) => {
            let parseDate = formatDisplayDate(date)
            $("#date_sale").text(parseDate);
            $("#code_sale").text(code);
            $("#customer_sale").text(customer);
        }

        const setRoutePrint = (key) => {
            var route = "{{ route('sale.print', ":id") }}";
            let url = route.replace(':id', key);
            $('#print_invoice').attr('action', url);
            $('#print_travel').attr('action', url);
        }
    </script>
@endpush
