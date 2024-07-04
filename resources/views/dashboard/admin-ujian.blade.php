<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('dashboard.admin') }}>Beranda</a> / <a href="">Dashboard Admin
                    Ujian</a>
            </p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="/assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Halo Admin!!</h2>
                            <h3>Halaman ini merupakan halaman yang Anda gunakan untuk melakukan pengelolaan data
                                pendaftaran setoran program tahfidz
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <p class="font-semibold text-2xl">Pendaftaran Ujian</p>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-primary-app text-white dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fakultas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jurusan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Hafalan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Penguji
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Panitia
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $s)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 font-bold">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $s->santri->nim }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $s->santri->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $s->santri->major->faculty->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $s->santri->major->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $s->santri->jumlah_hafalan }} Juz
                                </td>
                                <td class="px-6 py-4">
                                    <div class="border rounded p-2 font-bold">
                                        {{ $s->penguji_verified == '1' ? 'Disetujui' : ($s->penguji_verified == '0' ? 'Ditolak' : 'Diproses') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="border rounded p-2 font-bold">
                                        {{ $s->panitia_verified == '1' ? 'Disetujui' : ($s->panitia_verified == '0' ? 'Ditolak' : 'Diproses') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    <div class="flex gap-2">
                                        <a href="{{ route('dashboard.admin.ujian-penguji', $s->id) }}"
                                            class="btn btn-sm" type="button">
                                            Penguji
                                            <i class="bi bi-journal-text"></i></a>

                                        <a href="{{ route('dashboard.admin.ujian-panitia', $s->id) }}"
                                            class="btn btn-sm" type="button">
                                            Panitia
                                            <i class="bi bi-journal-text"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="text-xl font-bold my-4">
                    Ujian diterima
                </div>
                <table id="pendaftaranUjian" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="background: #CCCF95; ">Tgl Daftar</th>
                            <th class="text-center" style="background: #CCCF95;">Nama Santri</th>
                            <th class="text-center" style="background: #CCCF95;">Fakultas</th>
                            <th class="text-center" style="background: #CCCF95;">Jurusan</th>

                            <th class="text-center" style="background: #CCCF95; ">Status Program Panitia</th>
                            <th class="text-center" style="background: #CCCF95; ">Status Program Penguji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ujianDiterima as $p)
                            <tr>
                                <td>{{ $p->santri->created_at }}</td>
                                <td>{{ $p->santri->user->name }}</td>
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
                                                            <input type="radio" name="panitia_done" value="1"
                                                                {{ $p->panitia_done == '1' ? 'checked' : '' }}>
                                                            <div>Lulus Ujian</div>
                                                        </div>
                                                        <div class="flex gap-1 items-center">
                                                            <input type="radio" name="panitia_done" value="0"
                                                                {{ $p->panitia_done == '0' ? 'checked' : '' }}>
                                                            <div>Tidak Lulus</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="flex items-end gap-4 mt-6 justify-center">
                                                <x-primary-button
                                                    class="!bg-primary-app !px-4">{{ __('Simpan') }}</x-primary-button>


                                                @if (session('status') === 'profile-updated')
                                                    <p x-data="{ show: true }" x-show="show" x-transition
                                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                        {{ __('Saved.') }}
                                                    </p>
                                                @endif
                                            </div>
                                    </form>
                                </td>
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

            @if (count($pendaftaran) == 0)
                <p class="text-center text-2xl font-bold mt-4">Tidak ada data!</p>
            @endif



        </div>
    </section>
</x-app-layout>
