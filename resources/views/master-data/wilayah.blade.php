<x-dynamic-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wilayah') }}
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
                                    <table class="w-full table-no-border">
                                        <tr>
                                            <td>
                                                <label for="id_provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Provinsi
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout section="ssr-dropdown" get="provinsi" placeholder="Pilih provinsi..." /></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="id_kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kabupaten
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout section="ssr-dropdown" get="kabupaten" placeholder="Pilih kabupaten..." onclick="DropdownGetLoad('kabupaten', 'provinsi', 'wilayah')" /></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="id_kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kecamatan
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout section="ssr-dropdown" get="kecamatan" placeholder="Pilih kecamatan..." onclick="DropdownGetLoad('kecamatan', 'kabupaten', 'wilayah')" /></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="id_kelurahan" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kelurahan
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout section="ssr-dropdown" get="kelurahan" placeholder="Pilih kelurahan..." onclick="DropdownGetLoad('kelurahan', 'kecamatan', 'wilayah')" /></td>
                                        </tr>
                                    </table>

                                    <x-btn-customize-layout section="success" class="ms-4" onclick="cari(this)">
                                        {{ __('Cari') }}
                                    </x-btn-customize-layout>
                                </form>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div id="wilayah_container" x-cloak x-data="{ wilayahModal: false }" @click.outside="wilayahModal = false" @close.stop="wilayahModal = false"></div>

                <div class="mt-6 overflow-x-auto">
                    <div class="tabs">
                        <div class="flex border-b">
                            <button class="tab-header px-4 py-2 text-lg font-medium focus:outline-none bg-gray-100" data-tab-target="provinsi">
                                Provinsi
                            </button>
                            <button class="tab-header px-4 py-2 text-lg font-medium focus:outline-none" data-tab-target="kabupaten">
                                Kabupaten
                            </button>
                            <button class="tab-header px-4 py-2 text-lg font-medium focus:outline-none" data-tab-target="kecamatan">
                                Kecamatan
                            </button>
                            <button class="tab-header px-4 py-2 text-lg font-medium focus:outline-none" data-tab-target="kelurahan">
                                Kelurahan
                            </button>
                        </div>

                        <!-- Tab Contents -->
                        <div id="tab_provinsi" class="tab-content px-4 py-2 text-gray-700">
                            <table id="provinsiTable" class="min-w-full table-auto table-text-center-number">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">{{ __('No') }}</th>
                                        <th class="px-4 py-2">{{ __('Nama') }}</th>
                                        <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id="tab_kabupaten" class="tab-content hidden px-4 py-2 text-gray-700">
                            <table id="kabupatenTable" class="min-w-full table-auto table-text-center-number">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">{{ __('No') }}</th>
                                        <th class="px-4 py-2">{{ __('Nama') }}</th>
                                        <th class="px-4 py-2">{{ __('Provinsi') }}</th>
                                        <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id="tab_kecamatan" class="tab-content hidden px-4 py-2 text-gray-700">
                            <table id="kecamatanTable" class="min-w-full table-auto table-text-center-number">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">{{ __('No') }}</th>
                                        <th class="px-4 py-2">{{ __('Nama') }}</th>
                                        <th class="px-4 py-2">{{ __('Provinsi') }}</th>
                                        <th class="px-4 py-2">{{ __('Kabupaten') }}</th>
                                        <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id="tab_kelurahan" class="tab-content hidden px-4 py-2 text-gray-700">
                            <table id="kelurahanTable" class="min-w-full table-auto table-text-center-number">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">{{ __('No') }}</th>
                                        <th class="px-4 py-2">{{ __('Nama') }}</th>
                                        <th class="px-4 py-2">{{ __('Provinsi') }}</th>
                                        <th class="px-4 py-2">{{ __('Kabupaten') }}</th>
                                        <th class="px-4 py-2">{{ __('Kecamatan') }}</th>
                                        <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(async function() {
            (async function() {
                const $inputSlot = `
                <div class="mt-4">
                    <label for="nama">Nama *</label>
                    <input type="text" id="nama" name="nama" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                </div>
                `;
                await CreatePopUpModal("#wilayah_container", "wilayahModal", "Tambah Data", "wilayahForm", "simpanWilayah()", $inputSlot, "Form Tambah Data", "Wilayah", null, "Simpan", "Reset", "Tutup");
            })();

            $('.tab-header').on('click', async function() {
                const target = $(this).data('tab-target');
                $('.tab-content').addClass('hidden');
                $(`#tab_${target}`).removeClass('hidden');

                $('.tab-header').removeClass('bg-gray-100');
                $(this).addClass('bg-gray-100');

                const $coloumnsArray = [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                }];

                if (target == 'provinsi') {
                    $coloumnsArray.push({ data: 'name' });
                } else if (target == 'kabupaten') {
                    $coloumnsArray.push({ data: 'name' }, { data: 'provinsi' });
                } else if (target == 'kecamatan') {
                    $coloumnsArray.push({ data: 'name' }, { data: 'provinsi' }, { data: 'kabupaten' });
                } else if (target == 'kelurahan') {
                    $coloumnsArray.push({ data: 'name' }, { data: 'provinsi' }, { data: 'kabupaten' }, { data: 'kecamatan' });
                }

                $coloumnsArray.push({
                    data: null,
                    render: (data) =>
                        `<div class='flex gap-5 justify-center'>
                        <button class='inline-flex items-center px-4 py-2 bg-warning border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-warning focus:bg-warning active:bg-warning focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' data'>Edit</button>
                        <button class='inline-flex items-center px-4 py-2 bg-danger border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-danger focus:bg-danger active:bg-danger focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' data'>Hapus</button>
                    </div>` // Template class btn ada di file CustomizeBtnLayout.blade.php
                });
                await ContentLoaderDataTable(`/api/search?get_data=${target}`, `#${target}Table`, $coloumnsArray);
            });
        });
    </script>
</x-dynamic-layout>
