<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Kriteria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Kode</label>
                            <input type="text" name="kode"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Kode" value="{{ $generateId }}">
                            @error('kode')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Nama Kriteria</label>
                            <input type="text" name="nama" name="hs-leading-icon"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nama Kriteria">
                            @error('nama')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Atribut</label>
                            <select name="atribut"
                                class="py-3 px-4 mb-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 ">
                                <option value="" selected>Pilih Atribut</option>
                                <option value="cost">Cost</option>
                                <option value="benefit">Benefit</option>
                            </select>
                            @error('atribut')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Bobot</label>
                            <input type="text" name="bobot"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Bobot">
                            @error('bobot')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
