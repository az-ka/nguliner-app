<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nguliner</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    {{-- Perhitungn SAW --}}
    <div>
        @php
            $bobot = [];
        @endphp
        @foreach ($kriteria as $key => $value)
            @php
                $bobot[$value->id] = $value->bobot;
            @endphp
        @endforeach

        @php
            $rangking = [];
            $counter = 1;
        @endphp
        @foreach ($alternatif as $key => $value)
            @php
                $total = 0;
            @endphp
            @foreach ($value->crip->sortBy('kriteria_id') as $key => $crip)
                @if ($crip->kriteria->atribut == 'cost')
                    @php
                        $normalisasi = $kode_krit[$crip->kriteria->id] / $crip->nilai_crip;
                    @endphp
                @elseif($crip->kriteria->atribut == 'benefit')
                    @php
                        $normalisasi = $crip->nilai_crip / $kode_krit[$crip->kriteria->id];
                    @endphp
                @endif
                @php
                    $total = $total + $bobot[$crip->kriteria->id] * round($normalisasi, 2);
                @endphp
            @endforeach
            @php
                $rangking[] = [
                    'no' => $counter++,
                    'kode' => $value->kode_alternatif,
                    'nama' => $value->nama_alternatif,
                    'deskripsi' => $value->deskripsi,
                    'ranting' => $value->rating,
                    'total_ranting' => $value->total,
                    'maps' => $value->maps,
                    'total' => $total,
                ];
            @endphp
        @endforeach

        @php
            $a = 1;
            $hasil = collect($rangking)
                ->sortBy('total')
                ->reverse()
                ->toArray();
        @endphp

        @php
            usort($rangking, function ($a, $b) {
                return $b['total'] <=> $a['total'];
            });
        @endphp

        @foreach ($rangking as $key => $value)
            @php
                $rangking[$key]['no'] = $key + 1;
            @endphp
        @endforeach

        {{-- @dd($rangking); --}}
        {{-- @foreach ($rangking as $key => $value)
            @if ($key <= '2')
                <tr>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                        {{ $value['kode'] }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        {{ $value['nama'] }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        {{ $value['total'] }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        {{ $a++ }}
                    </td>
                </tr>
            @endif
        @endforeach --}}
    </div>
    <div class="min-h-screen font-sans antialiased relative">
        <div class="relative">
            <main class="text-neutral-800">

                {{-- Hero --}}
                <div class="w-full flex h-screen" data-v-b444fb2c="">
                    <section id="hero" class="w-full pb-24 my-auto" data-v-b444fb2c="">
                        <div class="relative max-w-screen-xl px-4 sm:px-8 mx-auto grid grid-cols-12 gap-x-6 overflow-hidden"
                            data-v-b444fb2c="">
                            <div class="col-span-12 lg:col-span-6 mt-12 xl:mt-10 space-y-4 sm:space-y-6 px-6 text-center sm:text-left"
                                data-v-b444fb2c="">
                                <span data-aos="fade-right" data-aos-once="true"
                                    class="text-base text-gradient font-semibold uppercase aos-init aos-animate"
                                    data-v-b444fb2c="">
                                    Selamat Datang Di <span class="text-purple-700">NGULINER</span>
                                </span>
                                <h1 data-aos="fade-right" data-aos-once="true"
                                    class="text-[2.5rem] sm:text-5xl xl:text-6xl font-bold leading-tight capitalize sm:pr-8 xl:pr-10 aos-init aos-animate"
                                    data-v-b444fb2c="">
                                    Kulineran
                                    {{-- <span class="text-header-gradient" data-v-b444fb2c="">Di Amikom
                                        Yogyakarta</span> --}}
                                    <br>Di <span class="text-purple-700">Amikom</span> Yogyakarta
                                </h1>
                                <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300"
                                    class="paragraph hidden sm:block aos-init aos-animate" data-v-b444fb2c="">
                                    Selamat datang di Nguliner, website yang membantu Anda menemukan tempat kuliner
                                    terbaik di sekitar AMIKOM Yogyakarta dengan mudah dan praktis. Kami menyediakan
                                    informasi lengkap tentang berbagai macam tempat makan di sekitar kampus, mulai dari
                                    warung makan, restoran, kafe, hingga tempat makan cepat saji.Dengan Nguliner, Anda
                                    tidak perlu lagi bingung memilih tempat makan yang tepat untuk memenuhi kebutuhan
                                    kuliner Anda. Kami menyajikan rekomendasi tempat makan yang sudah teruji dan
                                    terpercaya, sehingga Anda dapat menikmati makanan enak dengan tenang dan puas.
                                </p>
                            </div>
                            <div class="hidden sm:block col-span-12 lg:col-span-6" data-v-b444fb2c="">
                                <div class="w-full" data-v-b444fb2c=""><img data-aos="fade-up" data-aos-once="true"
                                        src="{{ asset('assets/img/hero.png') }}" alt="" class="rounded-xl"
                                        data-v-b444fb2c=""></div>
                            </div>
                            <img data-aos="fade-up" data-aos-delay="300"
                                src="{{ asset('assets/img/pattern/ellipse-1.png') }}"
                                class="hidden sm:block absolute bottom-12 xl:bottom-16 left-4 xl:left-0 w-6 aos-init aos-animate"
                                data-v-b444fb2c="">
                            <img data-aos="fade-up" data-aos-delay="300"
                                src="{{ asset('assets/img/pattern/ellipse-2.png') }}"
                                class="hidden sm:block absolute top-4 sm:top-10 right-64 sm:right-96 xl:right-[32rem] w-6 aos-init aos-animate"
                                data-v-b444fb2c="">
                            <img data-aos="fade-up" data-aos-delay="300"
                                src="{{ asset('assets/img/pattern/ellipse-3.png') }}"
                                class="hidden sm:block absolute bottom-56 right-24 w-6 aos-init aos-animate"
                                data-v-b444fb2c="">
                            <img data-aos="fade-up" data-aos-delay="300"
                                src="{{ asset('assets/img/pattern/star.png') }}"
                                class="hidden sm:block absolute top-20 sm:top-28 right-16 lg:right-0 lg:left-[30rem] w-8 aos-init aos-animate"
                                data-v-b444fb2c="">
                        </div>
                    </section>
                </div>

                {{-- Top 3 --}}
                <div class="w-full flex h-screen">
                    <section
                        class="max-w-screen-xl my-auto mx-2 sm:mx-auto px-4 sm:px-6 lg:px-0 py-6 pb-20 sm:py-8 rounded-[2.25rem] sm:rounded-xl bg-white shadow-lg sm:shadow-md transform lg:-translate-y-12"
                        data-v-b444fb2c="">
                        <h1 class="font-bold text-xl mb-5 text-center">Berikut Adalah 3 Kuliner Terbaik Saat Ini</h1>
                        <div class="w-full flex flex-col lg:flex-row items-center justify-center" data-v-b444fb2c="">
                            <div data-aos="fade-up"
                                class="w-full lg:w-1/3 mt-6 lg:mt-0 overflow-hidden space-y-6 xl:border-r border-gray-200 lg:px-8 aos-init"
                                data-v-b444fb2c="">
                                <div class="w-full flex items-center justify-between">
                                    <span class="font-medium">
                                        🔥 Top 1
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    @foreach ($rangking as $key => $value)
                                        @if ($value['no'] == '1')
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div
                                                    class="px-2 sm:px-6 py-2 align-middle inline-block min-w-full overflow-hidden">
                                                    <img src="https://media.discordapp.net/attachments/1125528451428917389/1126170021803081869/f6f348c6-1b46-11ee-8520-0242ac110005_1.png?width=671&height=671"
                                                        alt="">
                                                    <div class="px-6 py-4">
                                                        <div class="font-bold text-xl mb-2">
                                                            {{ $value['nama'] }}
                                                        </div>
                                                        <p class="text-gray-700 text-base">
                                                            {{ $value['deskripsi'] }}
                                                        </p>
                                                    </div>
                                                    <div class="px-6 pt-4 pb-2 space-x-3">
                                                        <span
                                                            class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600 shadow-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-star-filled"
                                                                width="10" height="10" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                                                                    stroke-width="0" fill="currentColor"></path>
                                                            </svg>
                                                            {{ $value['ranting'] }}
                                                        </span>
                                                        <a href="{{ $value['maps'] }}"
                                                            class="inline-block bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 shadow-md">
                                                            📍 Lokasi
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="150"
                                class="w-full lg:w-1/3 mt-6 lg:mt-0 overflow-hidden space-y-6 xl:border-r border-gray-200 lg:px-8 aos-init"
                                data-v-b444fb2c="">
                                <div class="w-full flex items-center justify-between">
                                    <span class="font-medium">
                                        🚀 Top 2
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    @foreach ($rangking as $key => $value)
                                        @if ($value['no'] == '2')
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div
                                                    class="px-2 sm:px-6 py-2 align-middle inline-block min-w-full overflow-hidden">
                                                    <img src="https://media.discordapp.net/attachments/1125528451428917389/1126171503373848677/adc768b6-1b47-11ee-9804-0242ac110004_1.png?width=671&height=671"
                                                        alt="">
                                                    <div class="px-6 py-4">
                                                        <div class="font-bold text-xl mb-2">{{ $value['nama'] }}</div>
                                                        <p class="text-gray-700 text-base">
                                                            {{ $value['deskripsi'] }}
                                                        </p>
                                                    </div>
                                                    <div class="px-6 pt-4 pb-2 space-x-3">
                                                        <span
                                                            class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600 shadow-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-star-filled"
                                                                width="10" height="10" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none"></path>
                                                                <path
                                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                                                                    stroke-width="0" fill="currentColor"></path>
                                                            </svg>
                                                            {{ $value['ranting'] }}
                                                        </span>
                                                        <a href="{{ $value['maps'] }}"
                                                            class="inline-block bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 shadow-md">
                                                            📍 Lokasi
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="300"
                                class="w-full lg:w-1/3 mt-6 lg:mt-0 overflow-hidden space-y-6 lg:px-8 aos-init"
                                data-v-b444fb2c="">
                                <div class="w-full flex items-center justify-between"><span class="font-medium">
                                        💎 Top 3
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    @foreach ($rangking as $key => $value)
                                        @if ($value['no'] == '3')
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div
                                                    class="px-2 sm:px-6 py-2 align-middle inline-block min-w-full overflow-hidden">
                                                    <img src="https://media.discordapp.net/attachments/1125528451428917389/1126172385377275994/591ed9b0-1b48-11ee-93fb-0242ac110004_1.png?width=671&height=671"
                                                        alt="">
                                                    <div class="px-6 py-4">
                                                        <div class="font-bold text-xl mb-2">
                                                            {{ $value['nama'] }}
                                                        </div>
                                                        <p class="text-gray-700 text-base">
                                                            {{ $value['deskripsi'] }}
                                                        </p>
                                                    </div>
                                                    <div class="px-6 pt-4 pb-2 space-x-3">
                                                        <span
                                                            class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600 shadow-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-star-filled"
                                                                width="10" height="10" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none"></path>
                                                                <path
                                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                                                                    stroke-width="0" fill="currentColor"></path>
                                                            </svg>
                                                            {{ $value['ranting'] }}
                                                        </span>
                                                        <a href="{{ $value['maps'] }}"
                                                            class="inline-block bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 shadow-md">
                                                            📍 Lokasi
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- Semua --}}
                <div class="w-full flex h-screen">
                    <section
                        class="max-w-screen-xl my-auto mx-2 sm:mx-auto px-4 sm:px-6 lg:px-0 py-6 pb-20 sm:py-8 rounded-[2.25rem] sm:rounded-xl bg-white shadow-lg sm:shadow-md transform lg:-translate-y-12"
                        data-v-b444fb2c="">
                        <h1 class="font-bold text-xl mb-5 text-center">
                            Kuliner Yang Juga Gak Kalah Nich 🤤
                        </h1>
                        <div class="w-full flex flex-col lg:flex-row items-center justify-center" data-v-b444fb2c="">

                            <div class="">
                                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                                Rangking
                                            </th>
                                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                                Nama
                                            </th>
                                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                                Rating
                                            </th>
                                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                                Total
                                                Ulasan</th>
                                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                                                Maps
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                        @foreach ($rangking as $key => $value)
                                            @if ($value['total'])
                                                @if ($value['no'] >= '4')
                                                    <tr>
                                                        <th class="px-6 py-4 font-medium text-gray-900">
                                                            {{ $value['no'] }}</th>
                                                        <td class="px-6 py-4 font-medium text-gray-900">
                                                            {{ $value['nama'] }}</td>
                                                        <td class="px-6 py-4">
                                                            <span
                                                                class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-star-filled"
                                                                    width="10" height="10" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor"
                                                                    fill="none" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none"></path>
                                                                    <path
                                                                        d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                                                                        stroke-width="0" fill="currentColor"></path>
                                                                </svg>
                                                                {{ $value['ranting'] }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ $value['total_ranting'] }}
                                                        </td>
                                                        <td class="flex justify-end gap-4 px-6 py-4 font-medium">
                                                            <a href="{{ $value['maps'] }}"
                                                                class="inline-block bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                                                📍 Lokasi
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
