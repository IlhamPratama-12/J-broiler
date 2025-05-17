@extends('admin.includes.master', ['title' => $title, "page" => "partnerships"])


@section('content')
    <div class="container-fluid">
        <a href="{{ route('partnerships.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <div class="row mt-3">
            <div class="col-md-12 col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table id="customers">
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Type</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->type }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Nama Lengkap</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->full_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Telepon</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->phone }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Nama Bisnis/Usaha</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->business_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Alamat Bisnis/Usaha</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->business_address }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Sosial Media</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->sosial_media }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold py-1 pr-2">Catatan</td>
                                <td class="pr-2">:</td>
                                <td>{{ $partnership->notes }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
