<footer class="site-footer border-top" style="padding-bottom: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4 text-black font-weight-bold">Lokasi</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="google-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d992.7917874424159!2d119.94133226957786!3d-5.5422159648165845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbeb33026bcda55%3A0xec3139b880a2b3ba!2sFL%20Broiler!5e0!3m2!1sid!2sid!4v1692129933413!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4 text-black font-weight-bold">Kontak</h3>
                    <span class="d-block text-dark mb-2"><i class="fa-solid fa-location-dot mr-3 fa-lg"></i>
                        JALAN MONGISIDI 2, KELURAHAN BONTO SUNGGU,
                        KEC. BISSAPPU, KABUPATEN BANTAENG,
                        SULAWESI SELATAN 92451
                    </span>
                    <span class="d-block text-dark mb-2">
                        <i class="fa-solid fa-envelope mr-3 fa-lg"></i>
                        flbroilerbantaeng@gmail.com
                    </span>
                    <span class="d-block text-dark mb-2">
                        <a href="https://wa.me/message/W7RKBN2JWUHEC1" target="_blank" >
                            <i class="fa-brands fa-whatsapp mr-3 fa-lg"></i>
                            +62 823 4474 4665
                        </a>
                    </span>
                    <span class="d-block text-dark mb-2">
                        <i class="fa-solid fa-phone mr-3 fa-lg"></i>
                        +62 821 9324 4214
                    </span>
                    <span class="d-block text-dark mb-2">
                        <a href="https://www.instagram.com/flbroiler_/" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-instagram mr-3 fa-lg"></i>
                            flbroiler_
                        </a>
                    </span>
                    <span class="d-block text-dark mb-2">
                        <i class="fa-brands fa-tiktok mr-3 fa-lg"></i>
                        flbroiler_
                    </span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <h3 class="footer-heading mb-4 text-black font-weight-bold">Kirim Pesan</h3>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('main.guest.create') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="fullName" class="text-black">Nama Lengkap<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-0" id="fullName" name="full_name" required
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="phone" class="text-black mb-0">Nomer Telepon / WA<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="message" class="text-black">Pesan<span
                                            class="text-danger">*</span></label>
                                        <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="font-size: 15px">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-md-12">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    FL Broiler | by Ardi Tama
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>

        </div>
    </div>
</footer>
