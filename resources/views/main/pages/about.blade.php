@extends('main.includes.master', ["title" => "Tentang"])

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">About</strong></div>
            </div>
        </div>
    </div>
    <div class="site-section border-bottom" data-aos="fade">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="block-16">
                        <figure class="d-none d-md-block">
                            <img src="{{ asset('img/about3.jpg') }}" alt="Image placeholder" class="img-fluid rounded ">
                        </figure>
                        <figure class="d-sm-block d-md-none">
                            <img src="{{ asset('img/about.jpg') }}" alt="Image placeholder" class="img-fluid rounded ">
                        </figure>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="site-section-heading pt-3 mb-4">
                        <h2 class="text-black">TENTANG KAMI</h2>
                    </div>
                    <p class="text-justify">
                        Sebagai distributor ayam broiler, kami adalah jembatan
                        antara peternak yang berdedikasi dan pelanggan yang
                        menuntut kualitas. Dengan staf berpengalaman dan
                        jaringan yang luas, kami menjembatani kesenjangan
                        antara produksi dan konsumsi. Setiap langkah dalam
                        proses distribusi kami dijalani dengan teliti, menjaga agar
                        setiap potong ayam broiler yang sampai ke tangan
                        pelanggan adalah hasil dari perawatan terbaik dan
                        standar ketat.
                        Kami bangga menjadi bagian dari rantai pasok yang
                        membawa nutrisi berkualitas tinggi ke meja
                        masyarakat. Dalam setiap kilogram ayam broiler yang
                        kami distribusikan, terkandung dedikasi kami untuk
                        menyediakan sumber protein yang aman dan lezat. Kami
                        berkomitmen untuk menjaga keandalan dan integritas
                        dalam setiap transaksi, karena kami percaya bahwa
                        kepuasan pelanggan adalah tonggak kesuksesan kami.
                        Bersama peternak dan pelanggan, kami membentuk
                        komunitas yang saling mendukung, membangun
                        hubungan yang kokoh dalam industri ini. Distribusi ayam
                        broiler adalah lebih dari pekerjaan bagi kami, ini adalah
                        tanggung jawab untuk memenuhi kebutuhan
                        masyarakat akan pangan yang berkualitas. Dengan
                        penuh semangat, kami melangkah ke masa depan, terus
                        meningkatkan layanan kami demi kesejahteraan
                        bersama.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
