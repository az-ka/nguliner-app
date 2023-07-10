<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sub Kriteria') }}
            </h2>
            <a href="{{ route('crip.create') }}"
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
                                        Kriteria
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Nama Crip
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Nilai Crip
                                    </th>
                                    <th class="px-4 py-2 w-32"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($crips as $key => $value)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            {{ $value->kriteria->nama }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $value->nama_crip }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $value->nilai_crip }}
                                        </td>
                                        <td class="text-right space-x-5 flex py-2 text-gray-700">
                                            <form action="{{ route('crip.destroy', $value->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                                    href="{{ route('crip.edit', $value->id) }}">Edit</a>
                                                <button
                                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                                    Delete
                                                </button>
                                            </form>
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
