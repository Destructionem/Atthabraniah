<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.public-nav')

    <header class="relative bg-emerald-900 text-white overflow-hidden" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-600/30 rounded-full blur-3xl"></div>
        <div class="relative max-w-6xl mx-auto px-4 py-16 text-center">
            <span class="inline-block bg-white/10 border border-white/20 text-emerald-200 text-sm font-medium px-4 py-1.5 rounded-full mb-4">Tentang Kami</span>
            <h1 class="text-3xl md:text-5xl font-bold mb-2">Profil Pesantren</h1>
            <p class="text-emerald-100">Pondok Pesantren At-Thabraniah Paseban</p>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 py-16 space-y-20">

        <section>
            <div class="mb-8">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Sejarah</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Perjalanan Kami</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mt-3"></div>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8 text-gray-600 leading-relaxed space-y-4">
                <p>Pondok Pesantren At Thabraniah Paseban merupakan lembaga pendidikan Islam yang lahir dari semangat syiar dan dakwah para ulama Betawi dalam membina umat serta mencetak generasi yang beriman, berilmu, dan berakhlakul karimah. Keberadaan pondok pesantren ini tidak dapat dipisahkan dari perjuangan seorang ulama kharismatik, KH. Muallim Ahmad Thabrani bin H. Sainan, yang sepanjang hidupnya mengabdikan diri untuk pendidikan, dakwah, dan pembinaan masyarakat di wilayah Paseban dan sekitarnya.</p>

                <p>Sejak masa sebelum kemerdekaan Indonesia, KH. Muallim Ahmad Thabrani bin H. Sainan telah aktif menyelenggarakan pengajian, majelis taklim, dan pendidikan agama bagi masyarakat. Melalui majelis-majelis ilmu yang beliau asuh, lahir banyak guru, mubaligh, dan tokoh agama yang kemudian turut berkontribusi dalam menyebarkan dakwah Islam di berbagai wilayah, khususnya di Tanah Betawi. Keteladanan, keikhlasan, dan dedikasi beliau menjadikan namanya dikenang sebagai salah satu tokoh penting dalam perkembangan pendidikan Islam di Paseban. <br>
                Perjuangan dakwah tersebut juga mendapat dukungan penuh dari keluarga beliau. Almarhumah Hajjah Sa'riyah mewakafkan tanahnya untuk pembangunan Masjid An-Nur, sementara Almarhum Haji Sainan mewakafkan tanahnya untuk berdirinya Madrasah Al-Huda. Wakaf tersebut menjadi fondasi utama berkembangnya kegiatan pendidikan dan dakwah Islam yang terus berlangsung hingga sekarang.</p>
                <p>Seiring berjalannya waktu dan semakin meningkatnya kebutuhan masyarakat terhadap pendidikan Islam yang lebih terstruktur, maka dibentuklah Yayasan Nurul Hidayah Atthabraniyah sebagai wadah pengelolaan dan pengembangan kegiatan pendidikan, sosial, dan dakwah. Yayasan ini memperoleh pengesahan melalui Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia Nomor AHU-4950.AH.01.04 Tahun 2010.</p>

                <P>Di bawah naungan yayasan tersebut, berbagai kegiatan pendidikan terus berkembang, baik pendidikan formal maupun nonformal. Program-program yang diselenggarakan meliputi Raudhatul Athfal (RA), Madrasah Diniyah, Majelis Taklim Kaum Bapak, Majelis Taklim Kaum Ibu, kursus Bahasa Arab, serta berbagai kegiatan sosial seperti santunan yatim piatu dan pembinaan masyarakat. </P>

                <p>Melihat perkembangan zaman yang semakin kompleks serta tantangan pergaulan generasi muda yang semakin besar, para pengurus yayasan memandang perlu adanya lembaga pendidikan yang mampu memberikan pembinaan agama secara lebih intensif, berkesinambungan, dan terarah. Berangkat dari cita-cita tersebut, pada tahun 2019 dirintislah pembangunan Pondok Pesantren At Thabraniah Paseban sebagai kelanjutan perjuangan dakwah para pendahulu. </p>

                <p>Pembangunan pondok pesantren diawali dengan pembebasan lahan, pembangunan asrama santri, ruang belajar, sarana ibadah, serta berbagai fasilitas penunjang pendidikan lainnya. Pondok pesantren ini didirikan dengan tujuan untuk mencetak generasi muslim yang memiliki pemahaman agama yang kuat, berakhlak mulia, mandiri, serta mampu memberikan manfaat bagi agama, masyarakat, bangsa, dan negara.</p>
                
                <p>Saat ini, estafet perjuangan dan pengembangan Pondok Pesantren At Thabraniah Paseban diteruskan oleh para penerus keluarga dan pengurus yayasan, salah satunya Muallim Maulana Kamal Yusuf, yang terus berupaya menjaga dan mengembangkan warisan dakwah serta pendidikan yang telah dirintis oleh para pendahulu. </p>
                
                <p>Dengan berlandaskan Al-Qur'an dan As-Sunnah serta semangat Ahlussunnah wal Jama'ah, Pondok Pesantren At Thabraniah Paseban hadir sebagai pusat pendidikan, dakwah, dan pembinaan umat yang berkomitmen melahirkan generasi Qurani yang berilmu, berakhlak, dan berkhidmat untuk kemajuan Islam dan bangsa Indonesia.</p>

                <p>"Melanjutkan Perjuangan Ulama, Mencetak Generasi Qurani, Berakhlak Mulia, dan Berkhidmat untuk Umat."
                </p>
            </div>
        </section>

        <section>
            <div class="mb-8 text-center">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Arah &amp; Tujuan</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Visi &amp; Misi</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-3"></div>
            </div>
            <div class="grid lg:grid-cols-2 gap-6">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-emerald-700 mb-3">Visi</h3>
                    <p class="text-gray-600">Menjadi lembaga pendidikan Islam yang unggul dalam membentuk generasi Qur'ani.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-emerald-700 mb-3">Misi</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-1">
                        <li>Menyelenggarakan pendidikan berbasis Al-Qur'an dan Sunnah.</li>
                        <li>Membina akhlak dan kemandirian santri.</li>
                        <li>Mengembangkan potensi akademik dan keterampilan.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <div class="mb-10 text-center">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Organisasi</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Struktur Organisasi</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-3"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-emerald-700 text-white rounded-xl px-6 py-3 text-center shadow-sm">
                    <p class="font-semibold">KH.Muhammad fikri muqaddas</p>
                    <p class="text-emerald-100 text-sm">Pengasuh / Pimpinan</p>
                </div>
                <div class="w-px h-8 bg-emerald-300"></div>
                <div class="bg-emerald-600 text-white rounded-xl px-6 py-3 text-center shadow-sm">
                    <p class="font-semibold">KH.Muhammad fikri muqaddas</p>
                    <p class="text-emerald-100 text-sm">Kepala Pesantren</p>
                </div>
                <div class="w-px h-8 bg-emerald-300"></div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 w-full max-w-3xl">
                    <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 text-center shadow-sm"><p class="font-semibold text-gray-800">[Nama]</p><p class="text-sm text-gray-500">Sekretaris</p></div>
                    <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 text-center shadow-sm"><p class="font-semibold text-gray-800">[Nama]</p><p class="text-sm text-gray-500">Bendahara</p></div>
                    <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 text-center shadow-sm"><p class="font-semibold text-gray-800">[Nama]</p><p class="text-sm text-gray-500">Bidang Pendidikan</p></div>
                </div>
            </div>
        </section>

        <section>
            <div class="mb-10 text-center">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Tim Kami</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Pengurus</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-3"></div>
            </div>
            @if ($pengurus->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($pengurus as $p)@include('profil.partials.kartu-orang', ['p' => $p])@endforeach
                </div>
            @else
                <p class="text-center text-gray-400">Data pengurus belum ditambahkan.</p>
            @endif
        </section>

        <section>
            <div class="mb-10 text-center">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Pengajar</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-1">Ustadz / Pengajar</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-3"></div>
            </div>
            @if ($pengajar->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($pengajar as $p)@include('profil.partials.kartu-orang', ['p' => $p])@endforeach
                </div>
            @else
                <p class="text-center text-gray-400">Data pengajar belum ditambahkan.</p>
            @endif
        </section>

    </div>

    @include('partials.footer')
</body>
</html>