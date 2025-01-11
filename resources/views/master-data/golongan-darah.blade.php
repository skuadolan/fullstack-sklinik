<x-dynamic-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Golongan Darah') }}
        </h2>
    </x-slot>

    <div class="w-full py-12">
        <div class="shadow max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset>
                        <legend class="text-xl font-semibold text-gray-800">
                            {{ __('Parameter Pencarian') }}
                        </legend>
                        <div class="w-full flex mb-4">
                            <div class="w-full sm:w-1/2 flex flex-wrap">
                                <form id="search" onsubmit="">
                                    <style>
                                        td {
                                            border: none !important;
                                        }
                                    </style>
                                    <table class="w-full">
                                        <tr>
                                            <td>
                                                <label for="golongan_darah" class="block text-gray-700 text-sm font-medium mb-2">
                                                    {{ __('Nama') }}
                                                </label>
                                            </td>
                                            <td class="text-center">:</td>
                                            <td class="w-full">
                                                <x-autocomplete-layout section="jquery" get="golongan_darah" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div id="goldar_container" x-cloak x-data="{ goldarModal: false }" @click.outside="goldarModal = false" @close.stop="goldarModal = false"></div>

                <div class="mt-6 overflow-x-auto">
                    <table id="golonganDarahTable" class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">{{ __('No') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Golongan Darah') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(async function () {
            (async function () {
                const $inputSlot = `
                <div class="mt-4">
                    <label for="nama">Nama *</label>
                    <input type="text" id="nama" name="nama" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                </div>
                `;
                await CreatePopUpModal("#goldar_container", "goldarModal", "Tambah Data", "goldarForm", "simpanGoldar()", $inputSlot);
            })();
        })
    </script>
</x-dynamic-layout>

<script>
    $(document).ready(function () {
        ContentLoaderDataTable('/master-data/golongan-darah', '#golonganDarahTable', [
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // No urut
            { data: 'name' }, // Nama
            { 
                data: null, 
                render: (data) => 
                    `<a href="#" class="px-4 py-2 text-white rounded-md bg-yellow-500 hover:bg-yellow-600">Edit</a>
                    &nbsp;&nbsp;
                    <a href="#" class="px-4 py-2 text-white rounded-md bg-red-500 hover:bg-red-600">Hapus</a>` 
            }
        ]);
    });

</script>