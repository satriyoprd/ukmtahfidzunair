<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">
            <p><a class="text-black" href={{ route('dashboard.admin') }}>Beranda</a> / <a href="">Dashboard Admin</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Halo Admin!!</h2>
                            <h3>Halaman ini merupakan halaman yang Anda gunakan untuk melakukan pengelolaan data santri
                                penghafal</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="font-bold text-3xl">
                    Kelola Pendaftaran Program Tahfidz
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="shadow-lg rounded-lg p-4">
                        <p class="text-xl font-semibold">Setoran</p>
                        <p>Program inti di UKM-TQ yang disusun oleh Departemen Kelas Tahfidz berupa setoran hafalan
                            Al-Qur’an oleh santri kepada penyimak (asatidz) yang bertempat di dua masjid UNAIR</p>

                        <div class="flex justify-end">
                            <a href={{route('dashboard.admin.setoran')}}><button
                                    class="bg-primary-app text-white py-2 px-3 rounded-lg min-w-[150px]">Kelola</button></a>
                        </div>

                    </div>
                    <div class="shadow-lg rounded-lg p-4">
                        <p class="text-xl font-semibold">Ujian</p>
                        <p>Program inti di UKM-TQ yang disusun oleh Departemen Kelas Tahfidz berupa setoran hafalan
                            Al-Qur’an oleh santri kepada penyimak (asatidz) yang bertempat di dua masjid UNAIR</p>

                        <div class="flex justify-end">
                            <a href={{route('dashboard.admin.ujian')}}><button
                                    class="bg-primary-app text-white py-2 px-3 rounded-lg min-w-[150px]">Kelola</button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
