@extends('admin.includes.master', ['title' => $title, 'page' => 'product-categories'])

@section('content')
    <div class="container-fluid">
        {{-- {{ dd($expense->products->count()) }} --}}
        <form action="{{ $route }}" method="POST">
            @csrf
            @if (isset($expense->id))
                @method('PUT')
            @endif
            <a href="{{ route('expenses.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="companis">Tercatat<span class="text-danger">*</span></label>
                                    <select class="form-control @error('company_id') is-invalid @enderror "
                                        id="companies" name="company_id" style="width: 100%;">
                                        @foreach ($companies as $comp)
                                            <option value="{{ $comp->id }}" {{ $comp->is_selected == true ? 'selected' : '' }}  >
                                                {{ $comp->name }}
                                            </option>
                                        @endforeach
                                        @if ($errors->has('company_id'))
                                            <span class="error invalid-feedback">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Tanggal<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        name="date" id="datepicker" placeholder="Hari-Bulan-Tahun">
                                    @if ($errors->has('date'))
                                        <span class="error invalid-feedback">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="types">Jenis Biaya<span class="text-danger">*</span></label>
                                    <select class="form-control @error('expense_type_id') is-invalid @enderror "
                                        id="types" name="expense_type_id" style="width: 100%;">
                                        <option disabled selected> Pilih Jenis Biaya</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ $type->id == $expense->expense_type_id ? 'selected' : '' }}  >
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal<span class="text-danger">*</span></label>
                                    <input type="text"
                                        id="nominal"
                                        name="nominal"
                                        placeholder="Nominal"
                                        onkeypress="return isNumber(event)"
                                        value="{{ $expense->nominal ?? old('nominal') }}"
                                        class="form-control  @error('nominal') is-invalid @enderror"
                                        />
                                    @if ($errors->has('nominal'))
                                        <span class="error invalid-feedback">{{ $errors->first('nominal') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="notes">Catatan</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Diskripsi">{{ $expense->notes ?? old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-5"><i class="fas fa-save mr-2"></i>Submit</button>
        </form>
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
        let expense = {!! isset($expense) ? json_encode($expense) : null !!};
        // SET VALUE DATE NOW
        let now = new Date()
        if (expense.date != null) {
            now = new Date(expense.date)
        }
        document.getElementById('datepicker').valueAsDate = now
    </script>
@endpush
