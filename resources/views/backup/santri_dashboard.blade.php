<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>UKM Tahfidz Qur'an Universitas Airlangga</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('assets/img/logo_ukm.png') }}" rel="icon">

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="w-100 d-flex align-items-center justify-content-center">

            <a href="index.html" class="logo"><img src="assets/img/logo_ukm.png" alt="" class="img-fluid"></a>
            <h1 class="logo me-5"><a href="index.html">UKM Tahfidz Qur'an<br>Universitas Airlangga</a></h1>

            <nav id="navbar" class="navbar">
                <div class="mx-5">
                    <ul>
                        <li><a class="nav-link scrollto" href="#hero">Beranda</a></li>
                        <li><a class="nav-link scrollto" href="tahfidz.html">Program Tahfidz</a></li>
                        <li><a class="nav-link scrollto" href="publikasi.html">Publikasi</a></li>
                        <li><a class="nav-link scrollto" href="#pengumuman">Pengumuman</a></li>
                        <li><a class="nav-link scrollto active" href="">Hafalan Saya</a></li>
                    </ul>
                </div>
                <div class="ms-5">
                    <ul>
                        <li><a class="register scrollto" href="register.html">Register</a></li>
                        <li><button class="login" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
                        </li>
                    </ul>
                </div>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>

    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Hafalan Saya</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Selamat Datang di Hafalan Anda</h2>
                            <h3>Halaman ini merupakan halaman hafalan Anda yang digunakan untuk memantau kegiatan hafal
                                dan progress Anda</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <div class="section-title pb-0">
                        <h2 id="dashboardTitle">Setoran</h2>
                    </div>
                </div>
                <div class="col-1">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-dashboard" type="button" id="dropdownMenu"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-caret-down-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu"
                            style="--bs-dropdown-link-active-bg: none">
                            <li><button class="dropdown-item text-black" onclick="dashboardSetoran()">Setoran</button>
                            </li>
                            <li><button class="dropdown-item text-black" onclick="dashboardUjian()">Ujian</button></li>
                            <li><button class="dropdown-item text-black" onclick="dashboardAbsen()">Absen</button></li>
                        </ul>
                    </div>
                </div>
                <div class="col-9">
                    <div class="float-end w-50">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Cari Data">
                        </div>
                    </div>
                </div>
            </div>

            <table id="tableSetoran" style="display: table;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Tgl Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Surat</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Jumlah Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 30%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($setoranSantri as $setoran)
                        <tr>
                            <td>{{ date('d F Y', strtotime($setoran->tgl_setoran)) }}</td>
                            <td>{{ $setoran->surat }}</td>
                            <td>{{ $setoran->jumlah_hafalan }}</td>
                            <td>{{ $setoran->nilai }}</td>
                            <td>{{ $setoran->catatan }}</td>
                            <td class="text-center">
                                <a class="btn btn-sm" type="button" href="/santri-setoran">
                                    <i class="bi bi-journal-text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                    <td>DummySetoran</td>
                    <td>DummySetoran</td>
                    <td>DummySetoran</td>
                    <td>DummySetoran</td>
                    <td>DummySetoran</td>
                    <td class="text-center"><button class="btn btn-sm" type="button"><i class="bi bi-journal-text"></i></button></td>
                  </tr> --}}
                </tbody>
            </table>

            <table id="tableUjian" style="display: none;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Tgl Ujian</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Surat</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Jumlah Hafalan</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 30%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td class="text-center">
                            <a class="btn btn-sm" type="button" href="/santri-ujian">
                                <i class="bi bi-journal-text"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div id="tableAbsen" style="display: none;">Under Maintenance</div>

        </div>
    </section>

    <!-- ======= Footer Section ======= -->
    <section id="footer" class="footer pb-0">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7571317010115!2d112.78204018368717!3d-7.268455448569584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa21117097cf%3A0x42c29739e70df5ca!2sMasjid%20Ulul%20&#39;Azmi!5e0!3m2!1sen!2sid!4v1713600038357!5m2!1sen!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 320px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <div class="info">
                        <div class="d-flex align-items-center mb-5">
                            <img src="assets/img/logo_ukm.png" alt="" class="img-fluid">
                            <h4>UKM Tahfidz Qur'an<br>Universitas Airlangga</h4>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p class="mb-4">MENU</p>
                                <a class="d-block mb-3 scrollto" href="#profil">Profil</a>
                                <a class="d-block mb-3 scrollto" href="#departemen">Departemen</a>
                                <a class="d-block mb-3 scrollto" href="#berita">Berita</a>
                                <a class="d-block mb-3 scrollto" href="#pengumuman">Pengumuman</a>
                            </div>
                            <div class="col-5">
                                <p class="mb-4">HUBUNGI KAMI</p>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="mailto:tahfidzukmunair@mail.com">tahfidzukmunair@mail.com</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="">+62 666655544433</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="">Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo, Surabaya,
                                            Jawa
                                            Timur 60115</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <p class="mb-4">IKUTI KAMI</p>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-instagram"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 80%;">
                                        <a href="">Instagram</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-youtube"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 80%;">
                                        <a href="">YouTube</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="copyright">
                <div class="row">
                    <div class="col">
                        <img src="assets/img/logo_ukm.png" class="img-fluid" alt="">
                        <img src="assets/img/logo_PENS.png" class="img-fluid" alt="">
                        <p>Powered by Satriyo Yoga Pradana</p>
                    </div>
                    <div class="col text-end">
                        <p>Hak Cipta &#169;2024 Satriyo</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Footer Section -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        function dashboardSetoran() {
            document.getElementById("dashboardTitle").innerHTML = "Setoran";
            document.getElementById("tableSetoran").style.display = "table";
            document.getElementById("tableUjian").style.display = "none";
            document.getElementById("tableAbsen").style.display = "none";
        };

        function dashboardUjian() {
            document.getElementById("dashboardTitle").innerHTML = "Ujian";
            document.getElementById("tableUjian").style.display = "table";
            document.getElementById("tableSetoran").style.display = "none";
            document.getElementById("tableAbsen").style.display = "none";
        };

        function dashboardAbsen() {
            document.getElementById("dashboardTitle").innerHTML = "Absen";
            document.getElementById("tableAbsen").style.display = "table";
            document.getElementById("tableSetoran").style.display = "none";
            document.getElementById("tableUjian").style.display = "none";
        };
    </script>

</body>

</html>
