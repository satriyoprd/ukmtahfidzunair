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
                <h2>Setoran</h2>
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

                <form method="POST" action="{{ route('setoran.update', $setoran->id) }}">

                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="penguji_id" value={{ Auth::user()->penguji->id }}>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputTglSetoran" class="form-label mb-0">Tgl Setoran</label>
                        </div>
                        <div class="col-10">
                            <input type="date" class="form-control form-control-sm" id="inputTglSetoran"
                                name="tanggal_setoran"
                                value="{{ old('tanggal_setoran', $setoran->tanggal_setoran ?? '') }}" required>
                            @error('tanggal_setoran')
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
                                    <option value="{{ $s->id }}"
                                        {{ old('santri_id', $setoran->santri->id ?? '') == $s->id ? 'selected' : '' }}>
                                        {{ $s->santri->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('santri_id')
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
                                    <option value="{{ $s->id }}"
                                        {{ in_array($s->id, $setoran->surats->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $s->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('surat')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputJmlSetoran" class="form-label mb-0">Jumlah Setoran</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" id="inputJmlSetoran"
                                name="jumlah_setoran"
                                value="{{ old('jumlah_setoran', $setoran->jumlah_setoran ?? '') }}" required>
                            @error('jumlah_setoran')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2 my-auto">
                            <label for="inputStatus" class="form-label mb-0">Status</label>
                        </div>
                        <div class="col-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusLanjut"
                                    value="1" {{ old('status', $setoran->status) == '1' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="statusLanjut">
                                    Lanjut
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusMenunggu"
                                    value="0" {{ old('status', $setoran->status) == '0' ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="statusMenunggu">
                                    Ulang
                                </label>
                            </div>
                            @error('status')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-4">
                        <div class="col-2 my-auto">
                            <label for="inputCatatan" class="form-label mb-0">Catatan</label>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control form-control-sm" id="inputCatatan" name="catatan" required>{{ old('catatan', $setoran->catatan ?? '') }}</textarea>
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
                                        value="{{ old('nilai_kelancaran', $setoran->nilais[0]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_kelancaran')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Makhraj" type="number" class="form-control form-control-sm"
                                        id="inputNilaiMakhraj" name="nilai_makhraj"
                                        value="{{ old('nilai_kelancaran', $setoran->nilais[1]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_makhraj')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Lagu" type="number" class="form-control form-control-sm"
                                        id="inputNilaiLagu" name="nilai_lagu"
                                        value="{{ old('nilai_kelancaran', $setoran->nilais[2]->pivot->nilai ?? '') }}"
                                        required>
                                    @error('nilai_lagu')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>

                                    <input placeholder="Adab" type="number" class="form-control form-control-sm"
                                        id="inputNilaiAdab" name="nilai_adab"
                                        value="{{ old('nilai_kelancaran', $setoran->nilais[3]->pivot->nilai ?? '') }}"
                                        required>
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
