<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('dashboard.admin') }}>Beranda</a> / <a href="">Dashboard Admin
                    Setoran</a>
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

            <p class="font-semibold text-2xl">Pendaftaran Setoran</p>

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
                                        <a href="{{ route('dashboard.admin.setoran-penguji', $s->id) }}"
                                            class="btn btn-sm" type="button">
                                            Penguji
                                            <i class="bi bi-journal-text"></i></a>

                                        <a href="{{ route('dashboard.admin.setoran-panitia', $s->id) }}"
                                            class="btn btn-sm" type="button">
                                            Panitia
                                            <i class="bi bi-journal-text"></i></a>


                                    </div>
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
