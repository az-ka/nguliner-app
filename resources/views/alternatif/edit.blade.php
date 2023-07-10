<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Alternatif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST" class="space-y-3">
                        @csrf
                        {{ method_field('PUT') }}
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Kode Alternatif</label>
                            <input type="text" name="kode_alternatif" name="hs-leading-icon"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Kode Alternatif" value="{{ $alternatif->kode_alternatif }}">
                            @error('kode_alternatif')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Nama Alternatif</label>
                            <input type="text" name="nama_alternatif" name="hs-leading-icon"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nama Alternatif" value="{{ $alternatif->nama_alternatif }}">
                            @error('nama_alternatif')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Rating</label>
                            <input type="text" name="rating" name="hs-leading-icon"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nama Alternatif" value="{{ $alternatif->rating }}">
                            @error('rating')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Total Ulasan</label>
                            <input type="text" name="total" name="hs-leading-icon"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nama Alternatif" value="{{ $alternatif->total }}">
                            @error('total')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Deskripsi
                                Singkat</label>
                            <textarea name="deskripsi" id="deskripsi"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                cols="30" rows="10">{{ $alternatif->deskripsi }}</textarea>
                            @error('deskripsi')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Alamat</label>
                            <textarea name="maps" id="maps"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                cols="30" rows="10">{{ $alternatif->maps }}</textarea>
                            @error('maps')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
