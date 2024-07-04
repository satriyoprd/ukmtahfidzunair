<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('home') }}>Beranda</a> / <a href="">Hafalan Saya</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="/assets/img/welcome.png" alt="" class="img-fluid">
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
                            <li><a class="dropdown-item text-black" href="{{ route('dashboard.santri') }}">Setoran</a>
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
                    @if ($ujianVerified->penguji_done != null || $ujianVerified->panitia_done != null)
                        <div class="bg-yellow-100 p-4 rounded-lg my-4">
                            <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                            <p class="text-yellow-800">Kamu belum mendaftar program ujian tahfidz, silahkan <a
                                    class="text-bold underline text-yellow-900"
                                    href={{ route('program.tahfidz') }}>Daftar
                                    di sini</a>
                        </div>
                    @else
                        <div class="bg-red-100 p-4 rounded-lg my-4">
                            <p class="text-2xl font-bold text-red-700">Pemberitahuan</p>
                            <p class="text-red-800">Pendaftaran program tahfidz ujian di tolak, kamu bisa mendaftar lagi
                                <a class="text-bold underline text-red-900" href={{ route('program.tahfidz') }}>Daftar
                                    di sini</a>
                        </div>
                    @endif

                    <table id="tableUjian" class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Program</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->santri->verifiedUjian->reverse() as $j)
                                <tr>
                                    <td>
                                        <div>
                                            {{ \Carbon\Carbon::parse($j->created_at)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        Program Ujian Tahfidz
                                        {{ \Carbon\Carbon::parse($j->created_at)->year }}
                                    </td>
                                    <td>
                                        @if ($loop->iteration > 1)
                                            Selesai
                                        @else
                                            {{ end($activeStepper) }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $j->penguji_done == '1' && $j->panitia_done == '1' ? 'Lulus' : 'Tidak Lulus' }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

                    <table id="tableUjian" class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Program</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>
                                <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->santri->verifiedUjian->reverse() as $j)
                                <tr>
                                    <td>
                                        <div>
                                            {{ \Carbon\Carbon::parse($j->created_at)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        Program Ujian Tahfidz
                                        {{ \Carbon\Carbon::parse($j->created_at)->year }}
                                    </td>
                                    <td>
                                        @if ($loop->iteration > 1)
                                            Selesai
                                        @else
                                            {{ end($activeStepper) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(end($activeStepper) == 'Registrasi')

                                        Lulus

                                        @else
                                        {{ $j->penguji_done == '1' && $j->panitia_done == '1' ? 'Lulus' : 'Tidak Lulus' }}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif ($ujianVerified->penguji_verified === 1 && $ujianVerified->panitia_verified === 1)
                    @if (end($activeStepper) != 'Pengumuman')
                        <div class="border-[2px] rounded p-4 mb-4 flex gap-3 items-center">
                            <div class="bg-[#075F7C33] rounded"><i class="p-3 fa-solid fa-bullhorn text-xl"></i></div>
                            <p class="text-xl font-medium mb-0">
                                Selamat! Anda telah <strong>diterima</strong> menjadi bagian program tahfidz ujian UKM
                                Tahfidz
                                Universitas
                                Airlangga.
                            </p>

                        </div>
                    @endif

                    @if ($activeStepper == ['Registrasi'])
                        <table id="tableUjian" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Program</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>
                                    <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->santri->verifiedUjian as $j)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ \Carbon\Carbon::parse($ujianVerified->created_at)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            Program Ujian Tahfidz
                                            {{ \Carbon\Carbon::parse($ujianVerified->created_at)->year }}
                                        </td>
                                        <td>
                                            @if ($loop->iteration > 1)
                                                Selesai
                                            @else
                                                {{ end($activeStepper) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $j->is_done == '1' ? 'Lulus' : 'Tidak Lulus' }}
                                        </td>

                                        <td>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    @endif

                    @if ($activeStepper == ['Registrasi', 'Ujian'])
                        <table id="tableUjian" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal Ujian</th>

                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>

                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>

                                    <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ujian->sortByDesc('created_at') as $j)
                                    <tr>
                                        <td>{{ $j->tanggal_ujian }}</td>
                                        <td>
                                            @if ($j->nilai != null)
                                                Hasil Ujian
                                            @else
                                                Ujian
                                            @endif
                                        </td>
                                        <td>Lulus</td>
                                        <td class="text-center">
                                            <a href={{ route('dashboard.santri.detail', $j->id) }} class="btn btn-sm"
                                                type="button">
                                                <i class="bi bi-journal-text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if ($activeStepper == ['Registrasi', 'Ujian', 'Hasil Ujian'])
                        <table id="tableUjian" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background: #CCCF95; ">Tgl Ujian</th>
                                    <th class="text-center" style="background: #CCCF95; ">Program</th>

                                    <th class="text-center" style="background: #CCCF95;">Tahapan</th>
                                    <th class="text-center" style="background: #CCCF95;">Status</th>
                                    <th class="text-center" style="background: #CCCF95;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ujian->sortByDesc('created_at') as $j)
                                    <tr>
                                        <td>{{ $j->tanggal_ujian }}</td>

                                        <td>Program Ujian Sertifikasi Tahfidz
                                            {{ \Carbon\Carbon::parse($ujianVerified->created_at)->year }}</td>

                                        <td> {{ end($activeStepper) }}</td>

                                        <td>Lulus</td>

                                        <td class="text-center"><a href={{ route('dashboard.santri.ujian', $j->id) }}
                                                class="btn btn-sm" type="button"><i
                                                    class="bi bi-journal-text"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif

                    @if ($activeStepper == ['Registrasi', 'Ujian', 'Hasil Ujian', 'Pengumuman'])


                        @if ($ujianVerified->penguji_done == '1' && $ujianVerified->panitia_done == '1')
                            <div class="border-[2px] rounded p-4 mb-4 flex gap-3 items-center">
                                <div class="bg-[#075F7C33] rounded"><i class="p-3 fa-solid fa-bullhorn text-xl"></i>
                                </div>
                                <p class="text-xl font-medium mb-0">
                                    Selamat! Anda telah <strong>lulus</strong> dari program Ujian Sertifikasi dan berhak
                                    mendapatkan beasiswa
                                    dari program kami
                                </p>

                            </div>
                        @else
                            <div class="border-[2px] bg-red-100 rounded p-4 mb-4 flex gap-3 items-center">
                                <div class="bg-red-200 rounded"><i
                                        class="p-3 fa-solid fa-bullhorn text-red-600 text-xl"></i>
                                </div>
                                <p class="text-xl text-red-600 font-medium mb-0">
                                    Tetap semangat dan coba lagi! Anda dinyatakan <strong>tidak lulus</strong> dari
                                    Program Ujian Sertifikasi Tahfidz
                                </p>

                            </div>
                        @endif


                        <form method="POST"
                            action="{{ route('santri-verified-ujian.update', $ujianVerified->id) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="penguji_verified" value="0">
                            <input type="hidden" name="panitia_verified" value="0">
                            <div class="flex justify-center">
                                <button type="submit" class="btn mx-auto w-32">Selesai</button>
                            </div>
                        </form>


                        <table id="tableUjian" class="table table-bordered mt-5">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Program</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>
                                    <th class="text-center" style="background: #CCCF95; width: 15%;">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->santri->verifiedUjian->reverse() as $j)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ \Carbon\Carbon::parse($j->created_at)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            Program Ujian Tahfidz
                                            {{ \Carbon\Carbon::parse($j->created_at)->year }}
                                        </td>
                                        <td>
                                            @if ($loop->iteration > 1)
                                                Selesai
                                            @else
                                                {{ end($activeStepper) }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $j->penguji_done == '1' && $j->panitia_done == '1' ? 'Lulus' : 'Tidak Lulus' }}
                                        </td>


                                        <td class="text-center">
                                            <a href="{{ route('dashboard.santri.pengumuman', ['ujianVerified' => $j->id]) }}"
                                                class="btn btn-sm" type="button">
                                                <i class="bi bi-journal-text"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif
                @endif
            @else
                <div class="bg-yellow-100 p-4 rounded-lg my-4">
                    <p class="text-2xl font-bold text-yellow-700">Pemberitahuan</p>
                    <p class="text-yellow-800">Kamu belum mendaftar program ujian tahfidz, silahkan <a
                            class="text-bold underline text-yellow-900" href={{ route('program.tahfidz') }}>Daftar
                            di sini</a>
                </div>

                <table id="tableUjian" class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th class="text-center" style="background: #CCCF95; width: 15%;">Tanggal</th>
                            <th class="text-center" style="background: #CCCF95; width: 15%;">Program</th>
                            <th class="text-center" style="background: #CCCF95; width: 15%;">Tahapan</th>
                            <th class="text-center" style="background: #CCCF95; width: 15%;">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->santri->verifiedUjian->reverse() as $j)
                            <tr>
                                <td>
                                    <div>
                                        {{ \Carbon\Carbon::parse($j->created_at)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    Program Ujian Tahfidz
                                    {{ \Carbon\Carbon::parse($j->created_at)->year }}
                                </td>
                                <td>
                                    @if ($loop->iteration > 1)
                                        Selesai
                                    @else
                                        {{ end($activeStepper) }}
                                    @endif
                                </td>
                                <td>
                                    {{ $j->penguji_done == '1' && $j->panitia_done == '1' ? 'Lulus' : 'Tidak Lulus' }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>



</x-app-layout>
