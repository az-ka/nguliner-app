<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perhitungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 text-center pb-3">List Alternatif Dan Kriteria</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Nama
                                    </th>
                                    @foreach ($kriteria as $key => $value)
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            {{ $value->nama }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($alternatif as $key => $value)
                                    @if (count($value->crip) > 0)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                {{ Str::limit($value->nama_alternatif, 35) }}
                                            </td>
                                            @foreach ($value->crip->sortBy('kriteria_id') as $key => $crip)
                                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                    {{ $crip->nama_crip }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 text-center pb-3">Analisa</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Kode
                                    </th>
                                    @foreach ($kriteria as $key => $value)
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            {{ $value->kode }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($alternatif as $key => $value)
                                    @if (count($value->crip) > 0)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                {{ $value->kode_alternatif }}
                                            </td>
                                            @foreach ($value->crip->sortBy('kriteria_id') as $key => $crip)
                                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                    {{ $crip->nilai_crip }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 text-center pb-3">Normalisasi</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Kode
                                    </th>
                                    @php
                                        $bobot = [];
                                    @endphp
                                    @foreach ($kriteria as $key => $value)
                                        @php
                                            $bobot[$value->id] = $value->bobot;
                                        @endphp
                                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            {{ $value->kode }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @php
                                    $rangking = [];
                                @endphp
                                @foreach ($alternatif as $key => $value)
                                    @if (count($value->crip) > 0)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                {{ $value->kode_alternatif }}
                                            </td>
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
                                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                    {{ round($normalisasi, 2) }}
                                                </td>
                                            @endforeach
                                            @php
                                                $rangking[] = [
                                                    'kode' => $value->kode_alternatif,
                                                    'nama' => $value->nama_alternatif,
                                                    'total' => $total,
                                                ];
                                            @endphp
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 text-center pb-3">Rangking</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Kode
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Nama
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Total
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Rangking
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @php
                                    $a = 1;
                                    $hasil = collect($rangking)
                                        ->sortBy('total')
                                        ->reverse()
                                        ->toArray();
                                @endphp

                                @foreach ($hasil as $key => $value)
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
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
