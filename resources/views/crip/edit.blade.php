<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Crip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('crip.update', $crip->id) }}" method="POST" class="space-y-3">
                        @csrf
                        {{ method_field('PUT') }}
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Kriteria</label>
                            <select name="kriteria"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach ($kriteria as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $crip->kriteria_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->kode . ' - ' . $k->nama }}</option>
                                @endforeach
                            </select>
                            @error('kriteria')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Nama Crip</label>
                            <input type="text" name="nama_crip" name="hs-leading-icon"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nama Crip" value="{{ $crip->nama_crip }}">
                            @error('nama_crip')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="hs-leading-icon" class="block text-sm font-medium mb-2">Nilai Crip</label>
                            <input type="text" name="nilai_crip" name="hs-leading-icon"
                                class="py-3 px-4 mb-4 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nilai Crip" value="{{ $crip->nilai_crip }}">
                            @error('nilai_crip')
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
