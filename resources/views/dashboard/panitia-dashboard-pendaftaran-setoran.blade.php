<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Dashboard</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Halo Panitia!!</h2>
                            <h3>Halaman ini merupakan halaman yang Anda gunakan untuk melakukan pengelolaan data santri
                                penghafal</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2 mr-10">
                    <div class="section-title pb-0">
                        <h2 id="dashboardTitle">Pendaftaran Setoran</h2>
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
                            <li><a class="dropdown-item text-black" href="{{ route('dashboard.panitia') }}">Pendaftaran
                                    Setoran</a></li>
                            <li><a class="dropdown-item text-black"
                                    href="{{ route('dashboard.panitia.pendaftaran-ujian') }}">Pendaftaran
                                    Ujian</a></li>
                            <li><a href="{{ route('dashboard.panitia.ujian') }}"
                                    class="dropdown-item font-normal text-black"
                                    onclick="dashboardPanitiaUjian()">Ujian</a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-5">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Data">
                    </div>
                </div>
            </div>

            <table id="tablePendaftaran" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; ">Tgl Daftar</th>
                        <th class="text-center" style="background: #CCCF95;">Nama Santri</th>
                        <th class="text-center" style="background: #CCCF95;">Jumlah Hafalan</th>
                        <th class="text-center" style="background: #CCCF95;">Fakultas</th>
                        <th class="text-center" style="background: #CCCF95;">Jurusan</th>
                        <th class="text-center" style="background: #CCCF95; ">Status</th>
                        <th class="text-center" style="background: #CCCF95; ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaranSetoran as $p)
                        <tr>
                            <td>{{ $p->santri->created_at }}</td>
                            <td>{{ $p->santri->user->name }}</td>
                            <td>{{ $p->santri->jumlah_hafalan }}</td>
                            <td>{{ $p->santri->major->faculty->name }}</td>
                            <td>{{ $p->santri->major->name }}</td>
                            <td class="px-6 py-4">
                                <div class="border rounded p-2 font-bold">
                                    {{ $p->panitia_verified == '1' ? 'Disetujui' : ($p->panitia_verified == '0' ? 'Ditolak' : 'Diproses') }}
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.panitia.pendaftaranSetoran', $p->id) }}"
                                    class="btn btn-sm" type="button"><i class="bi bi-journal-text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </section>
</x-app-layout>
