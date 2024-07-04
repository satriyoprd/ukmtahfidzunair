<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">
            <p><a class="text-black" href={{ route('dashboard.santri.ujian.index') }}>Beranda</a> / <a
                    href="">Detail
                    Ujian</a>
            </p>

            <div class="welcome mb-5 p-0">
                <div class="flex gap-4">
                    <div class="w-5 h-[150px] bg-primary-app">

                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0 px-4 pt-2">
                            <h2>Selesai</h2>
                            <h3 class="font-normal">Selamat! Kamu telah selesai dalam tahapan ujian program Ujian
                                Sertifikasi UKM Tahfidz
                                Universitas Airlangga.
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 items-center">
                <div class="font-bold text-2xl">
                    Detail Data Santri
                </div>
            </div>


            <div class="mt-4">
                <div class="text-xl font-semibold">
                    Data Santri
                </div>

                <div class="border shadow p-4 mt-2 flex flex-col gap-6">



                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nama Lengkap :
                        </div>

                        <div>
                            {{ $user->santri->user->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Status Santri
                        </div>

                        <div>
                            @if ($user->santri->jumlah_hafalan > 3)
                                Santri Khusus
                            @else
                                Santri Regular
                            @endif

                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nomor Induk Mahasiswa :
                        </div>

                        <div>
                            {{ $user->santri->nim }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nomor Handphone :
                        </div>

                        <div>
                            {{ $user->santri->user->phone }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jumlah Hafalan :
                        </div>

                        <div>
                            {{ $user->santri->jumlah_hafalan }} Juz
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Informasi Juz :
                        </div>

                        <div class="flex gap-2 flex-wrap items-center mt-2">
                            @if ($user->santri->informasi_hafalan)
                                @foreach ($user->santri->informasi_hafalan as $item)
                                    <div class="bg-primary-app text-white rounded-xl px-4">
                                        Juz {{ $item }}
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Fakultas :
                        </div>

                        <div>
                            {{ $user->santri->major->faculty->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jurusan :
                        </div>

                        <div>
                            {{ $user->santri->major->name }}
                        </div>
                    </div>


                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Program :
                        </div>

                        <div>
                            <div>Ujian Sertifikasi Semester Genap 2024</div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="flex gap-4 items-center mt-4">
                <div class="font-bold text-2xl">
                    Detail Pelaksanaan Ujian
                </div>
            </div>

            <div class="mt-4">


                <div class="border shadow p-4 mt-2 flex flex-col gap-6">



                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Tanggal Ujian :
                        </div>

                        <div>
                            {{ $ujian->tanggal_ujian }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Tempat :
                        </div>

                        <div>
                            {{ $ujian->tempat->name }}

                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jam Ujian :
                        </div>

                        <div>
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $ujian->jam)->format('H:i') }}

                        </div>
                    </div>
                </div>
            </div>



    </section>
</x-app-layout>
