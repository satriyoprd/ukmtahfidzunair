<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Dashboard</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="/assets/img/welcome.png" alt="" class="img-fluid">
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
                        <h2 id="dashboardTitle">Ujian</h2>
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
                            <li><a class="dropdown-item text-black"
                                    href="{{ route('dashboard.panitia.pendaftaran-ujian') }}>Pendaftaran
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

            <a href={{ route('dashboard.panitia.ujian.create') }}><button
                    class="bg-primary-app text-white p-2 my-2 rounded-sm float-end">Tambah Data
                    Ujian</button></a>

            <table id="pendaftaranUjian" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; ">Tanggal Ujian</th>
                        <th class="text-center" style="background: #CCCF95; ">Jam Ujian</th>
                        <th class="text-center" style="background: #CCCF95;">Penguji</th>
                        <th class="text-center" style="background: #CCCF95;">Santri</th>
                        <th class="text-center" style="background: #CCCF95;">Tempat</th>


                        <th class="text-center" style="background: #CCCF95; ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujian as $u)
                        <tr>
                            <td>{{ $u->tanggal_ujian }}</td>
                            <td>{{ $u->jam }}</td>
                            <td>{{ $u->penguji->user->name }}</td>
                            <td>{{ $u->santri->user->name }}</td>
                            <td>{{ $u->tempat->name }}</td>

                            <td class="text-center"><a href={{ route('dashboard.panitia.ujian.edit', $u->id) }}
                                    class="btn btn-sm" type="button"><i class="bi bi-pencil-fill"></i></a>
                                <form action={{ route('ujian.destroy', $u->id) }} method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-delete" type="submit"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </section>
</x-app-layout>
