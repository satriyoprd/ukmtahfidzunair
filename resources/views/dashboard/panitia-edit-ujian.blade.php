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
                            <h2>Halo Panitia!!</h2>
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

            <form method="POST" action="{{ route('ujian.update.panitia', $ujian->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-2 my-auto">
                        <label for="inputTglSetoran" class="form-label mb-0">Tgl Ujian</label>
                    </div>
                    <div class="col-10">
                        <input type="date" class="form-control form-control-sm" id="inputTglSetoran"
                            name="tanggal_ujian" value="{{ old('tanggal_ujian', $ujian->tanggal_ujian ?? '') }}"
                            required>
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
                        <input type="time" class="form-control form-control-sm" id="inputTglSetoran" name="jam"
                            value="{{ old('jam', $ujian->jam ?? '') }}" required>
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
                            name="tempat_id" required>
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
                        <select type="text" class="form-control form-control-sm" id="inputPenguji" name="penguji_id"
                            required>
                            <option disabled>Pilih Nama Penguji</option>
                            @foreach ($penguji as $p)
                                <option value={{ $p->id }} {{ $ujian->penguji->id == $p->id ? 'selected' : '' }}>
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
                        <select class="form-control form-control-sm" id="inputNamaSantri" name="santri_id" required>
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


                <div class="float-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('dashboard.panitia.ujian') }}">Kembali</a>
                </div>
            </form>

        </div>

       
    </section>
</x-app-layout>
