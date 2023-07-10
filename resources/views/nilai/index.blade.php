<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nilai Alternatif') }}
            </h2>
            <a href="{{ route('alternatif.create') }}"
                class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    @foreach ($kriteria as $krit)
                                        <th scope="col"
                                            class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            {{ $krit->nama }}</th>
                                    @endforeach
                                    <th class="px-4 py-2 w-56"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @if (!empty($alternatif))
                                    @foreach ($alternatif as $key => $value)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                {{ $value->kode_alternatif }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                {{ Str::limit($value->nama_alternatif, 25) }}
                                            </td>
                                            @if ($value->crip->isNotEmpty())
                                                {{-- @dd($value->crip) --}}
                                                @foreach ($value->crip->sortBy('kriteria_id') as $crip)
                                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                        {{ $crip->nama_crip }}
                                                    </td>
                                                @endforeach
                                            @else
                                                <td colspan="{{ $kriteria->count() }}"
                                                    class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                                                    Kosong
                                                </td>
                                            @endif
                                            <td class="text-right space-x-5 flex py-2 text-gray-700">
                                                <a class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                                    href="{{ route('nilai.edit', $value->id) }}">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{ count($kriteria) + 1 }}"
                                            class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
