@extends('main.includes.master', ['title' => 'Kemitraan'])

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('main.home') }}">Home</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Kemitraan</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section border-bottom" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-12 px-3 py-3 mx-auto text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="text-black font-weight-bold mb-3">MITRA KERJA</h2>
                    <p class="mb-0">
                        Selamat datang di program kemitraan ayam broiler FL Broiler Kami adalah mitra terpercaya bagi
                        peternak,
                        membantu mereka memasuki industri ayam broiler dengan cara yang berkelanjutan, menguntungkan, dan
                        efisien. Program kami dirancang untuk mendukung pertumbuhan usaha Anda sambil menjaga kualitas dan
                        keberlanjutan dalam beternak ayam broiler.
                    </p>
                </div>
                <div class="col-12 px-3 py-3 mx-auto" data-aos="fade-up" data-aos-delay="">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mx-auto">
                                        <h6 class="pl-4 text-black"> Apa yang Kami Tawarkan:</h6>
                                        <ol>
                                            <li>Pemberian Bibit Berkualitas Tinggi</li>
                                            <li>Pakan Berkualitas</li>
                                            <li>Dukungan Teknis</li>
                                            <li>Pemantauan Kesehatan Ayam</li>
                                            <li>Pengolahan dan Pemasaran</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- <img src="images/img-6.png" class="image_6" style="width:100%"> --}}
                            <img src="{{ asset('img/partnership3.jpg') }}" alt="Image placeholder"
                                class="img-fluid rounded ">
                        </div>
                    </div>
                </div>
                <div class="col-10 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" data-aos="fade-up" data-aos-delay="">
                    <h3 class="text-black font-weight-bold">Proses Kemitraan</h3>
                    <p class="mb-0">
                        Kami akan berbicara dengan Anda untuk memahami tujuan Anda dan persyaratan kemitraan. Kami akan
                        menjelaskan rincian program dan bagaimana kami dapat bekerja bersama.
                    </p>
                </div>
                <div class="col-12 px-3 py-3 pt-md-5 pb-md-4 mx-auto" data-aos="fade-up" data-aos-delay="">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            {{-- <img src="images/img-6.png" class="image_6" style="width:100%"> --}}
                            <img src="{{ asset('img/partnership1.jpg') }}" alt="Image placeholder"
                                class="img-fluid rounded ">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mx-auto">
                                        <h6 class="text-black pl-2"> Rincian sebagai berikut:</h6>
                                        <table class="w-100">
                                            <tr>
                                                <td>
                                                    <p class="pl-2 mb-0">1. Pendampingan dan Pelatihan.</p>
                                                    <p class="pl-2">Kami akan memberikan pelatihan awal dan terus-menerus untuk memastikan Anda siap mengelola peternakan dengan baik.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="pl-2 mb-0">2. Pertumbuhan dan Keuntungan Bersama.</p>
                                                    <p class="pl-2">Kami akan berkolaborasi dalam manajemen peternakan, pemantauan kesehatan ayam, dan pengolahan produk hingga pemasaran.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="pl-2 mb-0">3. Keuntungan akan dibagi sesuai dengan perjanjian kemitraan.</p>
                                                    <p class="pl-2">Program kemitraan ayam broiler kami dirancang untuk menciptakan keseimbangan yang baik antara keuntungan bagi peternak dan pemenuhan standar kualitas yang tinggi..</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10 px-3 py-3 mx-auto text-center" data-aos="fade-up" data-aos-delay="">
                    <p class="mb-0">
                        Kami berharap dapat bekerja sama dengan Anda dalam menjalankan peternakan ayam broiler yang sukses dan berkelanjutan. Untuk informasi lebih lanjut, hubungi kami hari ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
