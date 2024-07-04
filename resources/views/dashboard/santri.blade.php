{{-- <x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('home') }}>Beranda</a> / <a href="">Hafalan Saya</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Selamat Datang di Hafalan Anda</h2>
                            <h3>Halaman ini merupakan halaman hafalan Anda yang digunakan untuk memantau kegiatan
                                hafal dan progress Anda</h3>
                        </div>
                    </div>
                </div>
            </div>



            <x-stepper :active="$activeStepper" />

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="text-center bg-green-100 text-green-600">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

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
                            <li><a class="dropdown-item text-black"
                                    href="{{ route('dashboard.santri') }}">Setoran</a>
                            </li>
                            <li><a class="dropdown-item text-black"
                                    href="{{ route('dashboard.santri.ujian.index') }}">Ujian</a>
                            </li>

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

            @if ($ujianVerified)
                @if ($ujianVerified->penguji_verified === 0 || $ujianVerified->panitia_verified === 0)
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                        <p class="text-yellow-800">Kamu belum mendaftar program setoran tahfidz, silahkan <a
                                class="text-bold underline text-yellow-900" href={{ route('program.tahfidz') }}>Daftar
                                di sini</a>
                    </div>
                @elseif (
                    ($ujianVerified->penguji_verified === 1 && is_null($ujianVerified->panitia_verified)) ||
                        (is_null($ujianVerified->penguji_verified) && $ujianVerified->panitia_verified === 1) ||
                        (is_null($ujianVerified->penguji_verified) && is_null($ujianVerified->panitia_verified)))
                    <div id="process-ujian" class="bg-green-100 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-700">Menunggu Status Pendaftaran <i
                                class="fa-solid fa-clock ml-2"></i></p>
                        <p class="text-gray-800">Kamu sudah mendaftar program ujian tahfidz, mohon menunggu proses
                            seleksi.
                    </div>
                @elseif ($ujianVerified->penguji_verified === 1 && $ujianVerified->panitia_verified === 1)
                    <div id="success-ujian" style="display: none;"
                        class="border-[2px] rounded p-4 mb-4 flex gap-3 items-center">
                        <div class="bg-[#075F7C33] rounded"><i class="p-3 fa-solid fa-bullhorn text-xl"></i></div>
                        <p class="text-xl font-medium mb-0">
                            Selamat! Anda telah <strong>diterima</strong> menjadi bagian program tahfidz ujian UKM
                            Tahfidz
                            Universitas
                            Airlangga.
                        </p>

                    </div>
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
                            @foreach ($ujian as $j)
                                <tr>
                                    <td>{{ $j->tanggal_ujian }}</td>
                                    <td class="flex flex-wrap gap-1 text-white">
                                        @foreach ($j->surats as $item)
                                            <div class="bg-primary-app text-xs p-2 rounded">
                                                {{ $item->name }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $j->jumlah_ujian }}</td>
                                    <td>{{ $j->nilai }}</td>

                                    <td>{{ $j->catatan }}</td>

                                    <td class="text-center"><a href={{ route('dashboard.santri.ujian', $j->id) }}
                                            class="btn btn-sm" type="button"><i class="bi bi-journal-text"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                <div class="bg-yellow-100 p-4 rounded-lg my-4">
                    <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                    <p class="text-yellow-800">Kamu belum mendaftar program ujian tahfidz, silahkan <a
                            class="text-bold underline text-yellow-900" href={{ route('program.tahfidz') }}>Daftar
                            di sini</a>
                </div>

            @endif


            <div id="tableAbsen" style="display: none;">Under Maintenance</div>

            @if ($santriVerified)
                @if ($santriVerified->penguji_verified === 0 || $santriVerified->panitia_verified === 0)
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                        <p class="text-yellow-800">Kamu belum mendaftar program setoran tahfidz, silahkan <a
                                class="text-bold underline text-yellow-900" href={{ route('program.tahfidz') }}>Daftar
                                di sini</a>
                    </div>
                @elseif (
                    ($santriVerified->penguji_verified === 1 && is_null($santriVerified->panitia_verified)) ||
                        (is_null($santriVerified->penguji_verified) && $santriVerified->panitia_verified === 1) ||
                        (is_null($santriVerified->penguji_verified) && is_null($santriVerified->panitia_verified)))
                    <div id="process-setoran" class="bg-green-100 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-700">Menunggu Status Pendaftaran <i
                                class="fa-solid fa-clock ml-2"></i></p>
                        <p class="text-gray-800">Kamu sudah mendaftar program setoran tahfidz, mohon menunggu proses
                            seleksi.
                    </div>
                @elseif ($santriVerified->penguji_verified === 1 && $santriVerified->panitia_verified === 1)
                    <div id="success-setoran" class="border-[2px] rounded p-4 mb-4 flex gap-3 items-center">
                        <div class="bg-[#075F7C33] rounded"><i class="p-3 fa-solid fa-bullhorn text-xl"></i></div>
                        <p class="text-xl font-medium mb-0">
                            Selamat! Anda telah <strong>diterima</strong> menjadi bagian program tahfidz setoran UKM
                            Tahfidz
                            Universitas
                            Airlangga.
                        </p>

                    </div>
                    <table id="tableSetoran" style="display: table;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Tgl Setoran</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Surat</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Jumlah Setoran</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Nilai</th>
                                <th class="text-center" style="background: #CCCF95; width: 30%;">Catatan</th>
                                <th class="text-center" style="background: #CCCF95; width: 10%;">Status</th>
                                <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setoran as $s)
                                <tr>
                                    <td>{{ $s->tanggal_setoran }}</td>
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
                                    <td class="text-center"><a href={{ route('dashboard.santri.setoran', $s->id) }}
                                            class="btn btn-sm" type="button"><i class="bi bi-journal-text"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($setoran->count() == 0)
                        <p class="text-center text-2xl font-bold">Tidak ada data!</p>
                    @endif
                @endif
            @else
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                    <p class="text-yellow-800">Kamu belum mendaftar program setoran tahfidz, silahkan <a
                            class="text-bold underline text-yellow-900" href={{ route('program.tahfidz') }}>Daftar
                            di sini</a>
                </div>
            @endif






        </div>
    </section>



</x-app-layout> --}}
