<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Nilai Alternatif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('nilai.update', $nilai_id) }}" method="POST" class="space-y-3">
                        @csrf
                        {{ method_field('PUT') }}
                        @foreach ($master_kriteria as $key => $value)
                            <div>
                                <label for="{{ $value->kode }}"
                                    class="block text-sm font-medium mb-2">{{ $value->nama }}</label>
                                <select name="{{ $value->kode }}"
                                    class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">-- Pilih {{ $value->nama }} --</option>

                                    @foreach ($value->crip as $crip)
                                        <option value="{{ $crip->id }}"
                                            {{ in_array($crip->id, $selected_crip) ? 'selected' : '' }}>
                                            {{ $crip->nama_crip }}</option>
                                    @endforeach
                                </select>
                                @error('kriteria')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
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
