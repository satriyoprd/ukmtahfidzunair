<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">
            <p><a class="text-black" href={{ route('dashboard.panitia') }}>Beranda</a> / <a href="">Detail
                    Pendaftara Setoran</a>
            </p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="/assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Halo <span class="capitalize">{{ Auth::user()->role->name }}</span> !!</h2>
                            <h3>Silakan ubah status program untuk menentukan kelulusan santri pada tahapan registrasi.
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
                            Tanggal Daftar :
                        </div>

                        <div>
                            {{ $pendaftaran->created_at }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nama Lengkap :
                        </div>

                        <div>
                            {{ $pendaftaran->santri->user->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Status Santri
                        </div>

                        <div>
                            @if ($pendaftaran->santri->jumlah_hafalan > 3)
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
                            {{ $pendaftaran->santri->nim }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nomor Handphone :
                        </div>

                        <div>
                            {{ $pendaftaran->santri->user->phone }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jumlah Hafalan :
                        </div>

                        <div>
                            {{ $pendaftaran->santri->jumlah_hafalan }} Juz
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Informasi Juz :
                        </div>

                        <div class="flex gap-2 flex-wrap items-center mt-2">
                            @if ($pendaftaran->santri->informasi_hafalan)
                                @foreach ($pendaftaran->santri->informasi_hafalan as $item)
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
                            {{ $pendaftaran->santri->major->faculty->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jurusan :
                        </div>

                        <div>
                            {{ $pendaftaran->santri->major->name }}
                        </div>
                    </div>


                </div>
            </div>

            <form action={{ route('santri-verified-setoran.update', $pendaftaran->id) }} method="post">
                @csrf
                @method('PUT')
                <div class="mt-8">
                    <div class="font-semibold text-xl">
                        Status Program
                    </div>

                    <div class="border shadow p-4 mt-2 flex flex-col gap-6">

                        <div class="flex gap-2 items-center">
                            <div class="font-semibold">
                                Status :
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="flex gap-1 items-center">
                                    <input type="radio" name="panitia_verified" value="1"
                                        {{ $pendaftaran->panitia_verified == '1' ? 'checked' : '' }}>
                                    <div>Disetujui</div>
                                </div>
                                <div class="flex gap-1 items-center">
                                    <input type="radio" name="panitia_verified" value="0"
                                        {{ $pendaftaran->panitia_verified == '0' ? 'checked' : '' }}>
                                    <div>Ditolak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-end gap-4 mt-6">
                    <x-primary-button class="!bg-primary-app !px-4">{{ __('Simpan') }}</x-primary-button>

                    <a href={{ route('dashboard.panitia') }}><button type="button"
                            class="border-[2px] py-1 px-4 font-bold text-primary-app rounded !border-primary-app">Batal</button></a>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>

    </section>
</x-app-layout>
