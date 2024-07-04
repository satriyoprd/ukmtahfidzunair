<x-app-layout>
    <section id="dashboard" class="my-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('dashboard.penguji') }}>Beranda</a> / <a href="">Dashboard</a>
            </p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="/assets/img/welcome.png" alt="" class="img-fluid">
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

            <div class="section-title">
                <h2>Ujian</h2>
            </div>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4">
                <div class="text-xl font-semibold">
                    Data Santri
                </div>

                <div class="border-gray-500 border  rounded-sm shadow-sm p-4 mt-2 flex flex-col gap-6">

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nama Lengkap :
                        </div>

                        <div>
                            {{ $ujian->santri->user->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Status Santri
                        </div>

                        <div>
                            @if ($ujian->santri->jumlah_hafalan > 3)
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
                            {{ $ujian->santri->nim }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Nomor Handphone :
                        </div>

                        <div>
                            {{ $ujian->santri->user->phone }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jumlah Hafalan :
                        </div>

                        <div>
                            {{ $ujian->santri->jumlah_hafalan }} Juz
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Informasi Juz :
                        </div>

                        <div>
                            {{ $ujian->santri->jumlah_hafalan }} Juz
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Fakultas :
                        </div>

                        <div>
                            {{ $ujian->santri->major->faculty->name }}
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <div class="font-semibold">
                            Jurusan :
                        </div>

                        <div>
                            {{ $ujian->santri->major->name }}
                        </div>
                    </div>


                </div>
            </div>

            <div class="flex flex-col gap-6 mt-8">

                <form method="POST" action="{{ route('ujian.update', $ujian->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputTglSetoran" class="form-label mb-0">Tgl Ujian</label>
                        </div>
                        <div class="col-10">
                            <input type="date" class="form-control form-control-sm" id="inputTglSetoran"
                                name="tanggal_ujian" value="{{ old('tanggal_ujian', $ujian->tanggal_ujian ?? '') }}"
                                disabled>
                            @error('tanggal_ujian')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputTglSetoran" class="form-label mb-0">Waktu Ujian</label>
                        </div>
                        <div class="col-10">
                            <input type="time" class="form-control form-control-sm" id="inputTglSetoran"
                                name="jam" value="{{ old('jam', $ujian->jam ?? '') }}" disabled>
                            @error('jam')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputNamaSantri" class="form-label mb-0">Tempat Ujian</label>
                        </div>
                        <div class="col-10">
                            <select type="text" class="form-control form-control-sm" id="inputNamaSantri"
                                name="tempat_id" disabled>
                                <option disabled selected>Pilih Tempat Ujian</option>
                                @foreach ($tempat as $t)
                                    <option value={{ $t->id }}
                                        {{ old('tempat_id', $ujian->tempat->id ?? '') == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}</option>
                                @endforeach
                            </select>
                            @error('tempat_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputPenguji" class="form-label mb-0">Nama Penguji</label>
                        </div>
                        <div class="col-10">
                            <select type="text" class="form-control form-control-sm" id="inputPenguji"
                                name="penguji_id" disabled>
                                <option disabled>Pilih Nama Penguji</option>
                                @foreach ($penguji as $p)
                                    <option value={{ $p->id }}
                                        {{ $ujian->penguji->id == $p->id ? 'selected' : '' }}>
                                        {{ $p->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penguji_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputNamaSantri" class="form-label mb-0">Nama Santri</label>
                        </div>
                        <div class="col-10">
                            <select class="form-control form-control-sm" id="inputNamaSantri" name="santri_id" disabled
                                required>
                                <option disabled selected>Pilih Nama Santri</option>
                                @foreach ($santri as $s)
                                    <option value="{{ $s->santri->id }}"
                                        {{ $ujian->santri->id == $s->santri->id ? 'selected' : '' }}>

                                        {{ $s->santri->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('santri_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-2 my-auto">
                            <label for="inputCatatan" class="form-label mb-0">Catatan</label>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control form-control-sm" id="inputCatatan" name="catatan" required>{{ old('catatan', $ujian->catatan ?? '') }}</textarea>
                            @error('catatan')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label class="form-label mb-0">Nilai</label>
                        </div>
                        <div class="col-10">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <input placeholder="Kelancaran" type="number"
                                        class="form-control form-control-sm" id="inputNilaiKelancaran"
                                        name="nilai_kelancaran"
                                        value="{{ old('nilai_kelancaran', $ujian->nilais[0]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_kelancaran')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Makhraj" type="number" class="form-control form-control-sm"
                                        id="inputNilaiMakhraj" name="nilai_makhraj"
                                        value="{{ old('nilai_kelancaran', $ujian->nilais[1]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_makhraj')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Lagu" type="number" class="form-control form-control-sm"
                                        id="inputNilaiLagu" name="nilai_lagu"
                                        value="{{ old('nilai_kelancaran', $ujian->nilais[2]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_lagu')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Adab" type="number" class="form-control form-control-sm"
                                        id="inputNilaiAdab" name="nilai_adab"
                                        value="{{ old('nilai_kelancaran', $ujian->nilais[3]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_adab')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-2 my-auto">
                            <label class="form-label mb-0">Hasil Ujian</label>
                        </div>
                        <div class="col-10 d-flex align-items-center gap-3 mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDone" id="isDoneSelesai"
                                    {{ $ujian->isDone == '1' ? 'checked' : '' }} value="1">
                                <label class="form-check-label" for="isDoneSelesai">Selesai</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDone" id="isDoneBelum"
                                    {{ $ujian->isDone == '0' ? 'checked' : '' }} value="0">
                                <label class="form-check-label" for="isDoneBelum">Belum</label>
                            </div>
                        </div>
                    </div>

                    <div class="float-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-secondary" href="{{ route('dashboard.panitia.ujian') }}">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
