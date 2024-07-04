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
            <div id="edit">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('ujian.store') }}">
                    @csrf
                    <input type="hidden" name="penguji_id" value={{ Auth::user()->penguji->id }}>
                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputTglSetoran" class="form-label mb-0">Tgl Ujian</label>
                        </div>
                        <div class="col-10">
                            <input type="date" class="form-control form-control-sm" id="inputTglSetoran"
                                name="tanggal_ujian" value="{{ old('tanggal_ujian') }}" required>
                            @error('tanggal_ujian')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputTglSetoran" class="form-label mb-0">Tgl Setoran</label>
                        </div>
                        <div class="col-10">
                            <input type="time" class="form-control form-control-sm" id="inputTglSetoran"
                                name="jam" value="{{ old('jam') }}" required>
                            @error('jam')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputNamaSantri" class="form-label mb-0">Nama Santri</label>
                        </div>
                        <div class="col-10">
                            <select type="text" class="form-control form-control-sm" id="inputNamaSantri"
                                name="santri_id" value="{{ old('nama_santri') }}" required>
                                <option disabled selected>Pilih Nama Santri</option>
                                @foreach ($santri as $s)
                                    <option value={{ $s->santri->id }}>{{ $s->santri->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_santri')
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
                                name="tempat_id" value="{{ old('tempat_id') }}" required>
                                <option disabled selected>Pilih Tempat Ujian</option>
                                @foreach ($tempat as $t)
                                    <option value={{ $t->id }}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                            @error('tempat_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="surat" class="form-label mb-0">Surat</label>
                        </div>
                        <div class="col-10">
                            <select class="form-control form-control-sm" id="surat" name="surat[]" multiple>
                                <option disabled>Surat</option>
                                @foreach ($surat as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('surat')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputJmlSetoran" class="form-label mb-0">Jumlah Hafalan</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" id="inputJmlSetoran"
                                name="jumlah_ujian" value="{{ old('jumlah_ujian') }}" required>
                            @error('jumlah_ujian')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-2 my-auto">
                            <label for="inputCatatan" class="form-label mb-0">Catatan</label>
                        </div>
                        <div class="col-10">
                            <textarea type="text" class="form-control form-control-sm" id="inputCatatan" name="catatan"
                                value="{{ old('catatan') }}"></textarea>
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
                                        name="nilai_kelancaran" value="{{ old('nilai_kelancaran') }}">
                                    @error('nilai_kelancaran')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Makhraj" type="number" class="form-control form-control-sm"
                                        id="inputNilaiMakhraj" name="nilai_makhraj"
                                        value="{{ old('nilai_makhraj') }}">
                                    @error('nilai_makhraj')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Lagu" type="number" class="form-control form-control-sm"
                                        id="inputNilaiLagu" name="nilai_lagu" value="{{ old('nilai_lagu') }}">
                                    @error('nilai_lagu')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Adab" type="number" class="form-control form-control-sm"
                                        id="inputNilaiAdab" name="nilai_adab" value="{{ old('nilai_adab') }}">
                                    @error('nilai_adab')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="float-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-secondary" href="{{ route('dashboard.penguji') }}">Kembali</a>
                    </div>
                </form>


            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.getElementById('surat');
            const choices = new Choices(element, {
                searchEnabled: true,
                placeholderValue: 'Surat',
                removeItemButton: true,
                duplicateItemsAllowed: false,
                itemSelectText: '',
            });
        });
    </script>
</x-app-layout>
