@extends('admin.includes.master', ['title' => $title, 'page' => 'sales'])

@push('style')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <form action="{{ $route }}" method="POST" id="create-sales">
            @csrf
            @if (isset($sale->id))
                @method('PUT')
            @endif

            <a href="{{ route('sales.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
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

                                    <div class="form-group">
                                        <label for="products">Produk</label>
                                        <input type="hidden" name="sale_details" />
                                        <div class="row">
                                            <div class="col">
                                                <select class="form-control @error('sale_details') is-invalid @enderror "
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
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dynamic_field">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="20%">Nama</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="15%" class="text-right">Harga</th>
                                                    <th width="10%" class="text-right">Disc %</th>
                                                    <th width="10%" class="text-right">Disc Nominal</th>
                                                    <th width="15%" class="text-right">Harga Diskon</th>
                                                    <th width="15%" class="text-right">Sub Total</th>
                                                    <th width="5%"></th>
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
                                                                    placeholder="Qty" id="qty"
                                                                    value="{{ $item->qty }}"
                                                                    onkeypress="return isNumber(event)"
                                                                    class="form-control form-control-sm text-right"
                                                                    onchange="countSubTotal(this.value,'qty', {{ $key }})" />
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][price]"
                                                                    id="price_{{ $key }}"
                                                                    value="{{ $item->product->price }}" />
                                                                {{ number_format($item->product->price, 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][disc_percentage]"
                                                                    id="disc_percentage_{{ $key }}"
                                                                    value="{{ $item->product->disc_percentage }}" />
                                                                {{ $item->product->disc_percentage }}
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][disc_nominal]"
                                                                    id="disc_nominal_{{ $key }}"
                                                                    value="{{ $item->product->disc_nominal }}" />
                                                                {{ $item->product->disc_nominal }}
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][discounted_price]"
                                                                    id="discounted_price_{{ $key }}"
                                                                    value="{{ $item->product->final_price }}" />
                                                                {{ number_format($item->product->final_price, 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-right" style="vertical-align: unset">
                                                                <input type="hidden"
                                                                    name="sale_details[{{ $key }}][subtotal]"
                                                                    id="sub_total_{{ $key }}"
                                                                    value="{{ $item->subtotal }}" />
                                                                <label class="font-weight-normal"
                                                                    id="td_sub_total_{{ $key }}">
                                                                    {{ number_format($item->subtotal, 0, ',', '.') }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-tr"
                                                                    onclick="deleteRow('sub_total_{{ $key }}')">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between col-12 p-0">
                                    <div class="col-lg-4 col">
                                        <div class="form-group">
                                            <label for="notes">Catatan</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Catatan">{{ old('notes', $sale->notes ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Total</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="total" id="total"
                                                    value="{{ $sale->total ?? 0 }}" />
                                                <label class="col-form-label font-weight-normal" id="totalLabel">
                                                    {{ number_format($sale->total, 0, ',', '.') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="disPercentage" class="col-sm-4 col-form-label">Diskon %</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="disc_percentage" id="disPercentage" placeholder="Diskon %"
                                                    value="{{ $sale->disc_percentage }}"
                                                    onkeypress="return isNumber(event)" onchange="countDiskon(this)">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="disNominal" class="col-sm-4 col-form-label">Diskon Nominal</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="disc_nominal" id="disNominal" placeholder="Diskon Nominal"
                                                    value="{{ $sale->disc_nominal }}" onkeypress="return isNumber(event)"
                                                    onchange="countDiskon(this)">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Grand Total</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="grand_total" id="grand_total"
                                                    value="{{ $sale->grand_total ?? 0 }}" />
                                                <label class="col-form-label font-weight-normal" id="grandTotalLabel">
                                                    {{ number_format($sale->grand_total, 0, ',', '.') }}

                                                </label>
                                            </div>
                                        </div>
                                        <div class="w-30 mt-3">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-save mr-2"></i>Submit</button>
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
@endsection

@push('scripts')
    <script type="text/javascript">
        // let sales = null
        // let form = '#create-sales';
        // $(form).on('submit', function(event) {
        //     event.preventDefault();
        //     let url = $(this).attr('data-action');
        //     let data = $(this).serialize();
        //     let method = $(this).attr("method");
        //     $.ajax({
        //         url: url,
        //         method: method,
        //         data: data,
        //         success: function(response) {
        //             sales = response.data;
        //             console.log(response.data);
        //             $(form).trigger("reset");
        //         },
        //         error: function(response) {}
        //     });
        // });

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

        let sale = {!! isset($sale) ? json_encode($sale) : null !!};
        let saleDetails = {!! isset($sale) ? json_encode($sale->saleDetails) : '[]' !!};

        // SET VALUE DATE NOW
        let now = new Date()
        if (sale.date != null) {
            console.log("test");
            now = new Date(sale.date)
        }
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

        var i = (saleDetails.length > 0) ? saleDetails.length : 0;
        $("#add").click(function() {
            let data = $('#products').val()
            if (!data) {
                toastr.warning("Tidak ada data produk yg dipilih.")
            }
            let product = JSON.parse(data)
            let baseTotal = $(`#total`).val();
            let countTotal = parseInt(baseTotal) + product.final_price

            $(`#total`).val(countTotal)
            $(`#grand_total`).val(countTotal)
            $(`#totalLabel`).text(formatNumericDecimal(countTotal))
            $(`#grandTotalLabel`).text(formatNumericDecimal(countTotal))

            let price = formatNumericDecimal(product.price)
            let discounted_price = formatNumericDecimal(product.final_price)
            let total = formatNumericDecimal(product.final_price ?? 0)
            $("#dynamic_field").append(
                `<tr>
                    <td style="padding:8px;vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][product_id]" value="${parseInt(product.id)}"/>
                        <input type="hidden" name="sale_details[${i}][product_name]" value="${product.name}"/>
                        ${product.name}
                    </td>
                    <td style="vertical-align: unset">
                        <input type="text" name="sale_details[${i}][qty]" placeholder="Qty" id="qty" value="1" onkeypress="return isNumber(event)"
                            class="form-control form-control-sm text-right" onchange="countSubTotal(this.value,'qty', ${i})"/>
                    </td>
                    <td class="text-right" style="vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][price]" id="price_${i}" value="${product.price}"/>
                        ${price}
                    </td>
                    <td class="text-right" style="vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][disc_percentage]" id="disc_percentage_${i}" value="${product.disc_percentage}" />
                        ${product.disc_percentage}
                    </td>
                    <td class="text-right" style="vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][disc_nominal]" id="disc_nominal_${i}" value="${product.disc_nominal}" />
                        ${product.disc_nominal}
                    </td>
                    <td class="text-right" style="vertical-align: unset">
                        <input type="hidden" name="sale_details[${i}][discounted_price]" id="discounted_price_${i}" value="${product.final_price}" />
                        ${discounted_price}
                    </td>
                    <td class="text-right" style="vertical-align: unset" >
                        <input type="hidden" name="sale_details[${i}][subtotal]" id="sub_total_${i}" value="${product.final_price}" />
                        <label class="font-weight-normal" id="td_sub_total_${i}">${total}</label>
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
            let disPer = $(`#disPercentage`).val('')
            let disNom = $(`#disNominal`).val('')

            $(`#total`).val(countTotal)
            $(`#grand_total`).val(countTotal)
            $(`#totalLabel`).text(formatNumericDecimal(countTotal))
            $(`#grandTotalLabel`).text(formatNumericDecimal(countTotal))
            $(this).parents('tr').remove();
        }

        $(document).on('click', '.remove-tr', function(event) {
            $(this).parents('tr').remove();
        });

        const countSubTotal = (value, field, i) => {
            let qty = 1
            let price = $(`input#price_${i}`).val();
            let disc = $(`input#disc_percentage_${i}`).val();
            let disc_nom = $(`input#disc_nominal_${i}`).val();
            let discounted_price = $(`input#discounted_price_${i}`).val();
            if (field == 'qty') {
                qty = value;
            }
            let total_disc = price * disc * 0.01;
            discounted_price = (price - total_disc - disc_nom);
            let sub_total = qty * discounted_price;

            $(`input#sub_total_${i}`).val(sub_total);
            $(`#td_sub_total_${i}`).text(formatNumericDecimal(sub_total));
            countTotal(i, discounted_price, sub_total)
            countDiskon()
        }

        const countDiskon = () => {
            let disPer = $(`#disPercentage`).val() ?? 0
            let disNom = $(`#disNominal`).val() ?? 0
            let total = $(`#total`).val() ?? 0

            let total_disc = total * disPer * 0.01;
            let grandTotal = (total - total_disc - disNom);
            $(`#grand_total`).val(grandTotal)
            $(`#grandTotalLabel`).text(formatNumericDecimal(grandTotal))
        }

        const countTotal = (index, before, after) => {
            let total = $(`#total`).val();
            let countTotal = (parseInt(total) - parseInt(before)) + parseInt(after)
            $(`#total`).val(countTotal)
            $(`#totalLabel`).text(formatNumericDecimal(countTotal))
            // let discounted = countTotal - (disc ?? 0)
            $(`#grand_total`).val(countTotal)
            $(`#grandTotalLabel`).text(formatNumericDecimal(countTotal))
        }
    </script>
@endpush
