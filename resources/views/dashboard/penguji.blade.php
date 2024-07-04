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
                            <h2>Halo Penguji!!</h2>
                            <h3>Halaman ini merupakan halaman yang Anda gunakan untuk melakukan pengelolaan data santri
                                penghafal</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2 mr-10">
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
                            <li><button class="dropdown-item text-black"
                                    onclick="dashboardPendaftaranSetoran()">Pendaftaran Setoran</button></li>
                            <li><button class="dropdown-item text-black"
                                    onclick="dashboardPendaftaranUjian()">Pendaftaran Ujian</button></li>
                            <li><button class="dropdown-item text-black" onclick="dashboardUjian()">Ujian</button></li>
                            <li><button class="dropdown-item text-black" onclick="dashboardAbsen()">Absen</button></li>
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

                <div class="col-7">
                    <div class="float-end w-25">
                        <a class="btn" id="dynamicButton"
                            href="{{ route('dashboard.penguji.setoran.create') }}">Tambah Data Setoran</a>
                    </div>
                </div>

            </div>

            <table id="tableSetoran" style="display: table;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Tgl Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Nama Santri</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Surat</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Jumlah Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 20%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 20%;">Status</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($setoran as $s)
                        <tr>
                            <td>{{ $s->tanggal_setoran }}</td>
                            <td>{{ $s->santri->user->name }}</td>
                            <td class="flex flex-wrap gap-1 text-white">
                                @foreach ($s->surats as $item)
                                    <div class="bg-primary-app text-xs p-2 rounded">
                                        {{ $item->name }}
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $s->jumlah_setoran }}</td>
                            <td>{{ $s->nilai }}</td>

                            <td>{{ $s->catatan }}</td>
                            <td>
                                @if ($s->status)
                                    <p>Lanjut</p>
                                @else
                                    <p>Menunggu</p>
                                @endif
                            </td>
                            <td class="text-center"><a href={{ route('dashboard.penguji.setoran.update', $s->id) }}
                                    class="btn btn-sm" type="button"><i class="bi bi-pencil-fill"></i></a>
                                <form action={{ route('setoran.destroy', $s->id) }} method="POST">

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

            <table id="tableUjian" style="display: none;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Tgl Ujian</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Nama Santri</th>
                        <th class="text-center" style="background: #CCCF95; width: 14%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 20%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujian as $j)
                        <tr>
                            <td>{{ $j->tanggal_ujian }}</td>
                            <td>{{ $j->santri->user->name }}</td>

                            <td>{{ $j->nilai == null ? 'Belum dinilai' : $j->nilai }}</td>

                            <td>{{ is_null($j->catatan) ? 'Belum ada catatan' : $j->catatan }}</td>


                            <td class="text-center"><a href={{ route('dashboard.penguji.ujian.update', $j->id) }}
                                    class="btn btn-sm" type="button"><i class="bi bi-pencil-fill"></i></a>
                                <form action={{ route('ujian.destroy', $j->id) }} method="POST">

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

            <table id="tablePendaftaran" style="display: none;" class="table table-bordered">
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
                            <td>{{ $p->penguji_verified == '1' ? 'Disetujui' : ($p->penguji_verified == '0' ? 'Ditolak' : 'Diproses') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.penguji.detail-santri', $p->id) }}" class="btn btn-sm"
                                    type="button"><i class="bi bi-journal-text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="tabelPendaftarUjian" style="display: none;">

                <table class="table table-bordered">
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
                        @foreach ($pendaftaranUjian as $p)
                            <tr>
                                <td>{{ $p->santri->created_at }}</td>
                                <td>{{ $p->santri->user->name }}</td>
                                <td>{{ $p->santri->jumlah_hafalan }}</td>
                                <td>{{ $p->santri->major->faculty->name }}</td>
                                <td>{{ $p->santri->major->name }}</td>
                                <td>{{ $p->penguji_verified == '1' ? 'Disetujui' : ($p->penguji_verified == '0' ? 'Ditolak' : 'Diproses') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.penguji.detail-ujian', $p->id) }}"
                                        class="btn btn-sm" type="button"><i class="bi bi-journal-text"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-xl font-bold mt-4">
                    Ujian Diterima
                </div>


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="background: #CCCF95; ">Tgl Daftar</th>
                            <th class="text-center" style="background: #CCCF95;">Nama Santri</th>
                            <th class="text-center" style="background: #CCCF95;">Jumlah Hafalan</th>
                            <th class="text-center" style="background: #CCCF95;">Fakultas</th>
                            <th class="text-center" style="background: #CCCF95;">Jurusan</th>
                            <th class="text-center" style="background: #CCCF95; ">Status Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ujianDiterima as $p)
                            <tr>
                                <td>{{ $p->santri->created_at }}</td>
                                <td>{{ $p->santri->user->name }}</td>
                                <td>{{ $p->santri->jumlah_hafalan }}</td>
                                <td>{{ $p->santri->major->faculty->name }}</td>
                                <td>{{ $p->santri->major->name }}</td>


                                <td class="text-center">
                                    <form action={{ route('santri-verified-ujian.update.done', $p->id) }}
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-8">

                                            <div class="border shadow p-4 mt-2 flex flex-col gap-6">

                                                <div class="flex gap-2 items-center">
                                                    <div class="flex gap-4 items-center">
                                                        <div class="flex gap-1 items-center">
                                                            <input type="radio" name="penguji_done" value="1"
                                                                {{ $p->penguji_done == '1' ? 'checked' : '' }}>
                                                            <div>Lulus Ujian</div>
                                                        </div>
                                                        <div class="flex gap-1 items-center">
                                                            <input type="radio" name="penguji_done" value="0"
                                                                {{ $p->penguji_done == '0' ? 'checked' : '' }}>
                                                            <div>Tidak Lulus</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="flex items-end gap-4 mt-6 justify-center">
                                                <x-primary-button
                                                    class="!bg-primary-app !px-4">{{ __('Simpan') }}</x-primary-button>

                                                <a href={{ route('dashboard.panitia') }}><button type="button"
                                                        class="border-[2px] py-1 px-4 font-bold text-primary-app rounded !border-primary-app">Batal</button></a>

                                                @if (session('status') === 'profile-updated')
                                                    <p x-data="{ show: true }" x-show="show" x-transition
                                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                        {{ __('Saved.') }}
                                                    </p>
                                                @endif
                                            </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




            <div id="tableAbsen" style="display: none;">Under Maintenance</div>

        </div>
    </section>
</x-app-layout>
