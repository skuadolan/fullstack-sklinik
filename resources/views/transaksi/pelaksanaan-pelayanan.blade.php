<x-dynamic-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelaksanaan Pelayanan') }}
        </h2>
    </x-slot>

    <div class="w-full py-12">
        <div class="shadow max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="p-6 text-gray-900">
                    <fieldset>
                        <legend class="text-xl font-semibold text-gray-800">
                            {{ __('Parameter Pencarian') }}
                        </legend>
                        <div class="w-full flex mb-4">
                            <div class="w-full sm:w-1/2 flex flex-wrap">
                                <form id="searchForm" onsubmit="search('submit')">
                                    <table class="w-full table-no-border">
                                        <tr class="align-baseline">
                                            <td>
                                                <label for="id_unit" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Unit
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout id="unit" name="unit" class="check_form_search w-full px-4 py-2 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 rounded-md shadow-sm bg-white text-gray-700 hover:bg-gray-100 transition-all duration-200" section="ssr-dropdown" get="unit" placeholder="Pilih Unit..." /></td>
                                        </tr>
                                    </table>

                                    <x-btn-customize-layout type="button" id="btnSearch" section="success" class="ms-4" onclick="search('submit')">
                                        {{ __('Cari') }}
                                    </x-btn-customize-layout>

                                    <x-btn-customize-layout type="reset" section="danger" class="ms-4" onclick="search('reset')">
                                        {{ __('Reset') }}
                                    </x-btn-customize-layout>
                                </form>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table id="pelaksanaan_pelayananTable" class="cek_datatables_content min-w-full table-auto table-text-center-number">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">{{ __('No') }}</th>
                                <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                <th class="px-4 py-2">{{ __('No.RM') }}</th>
                                <th class="px-4 py-2">{{ __('NIK') }}</th>
                                <th class="px-4 py-2">{{ __('Nama') }}</th>
                                <th class="px-4 py-2">{{ __('Alamat') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(async function() {
            (async function() {
            })();
        });
    </script>
</x-dynamic-layout>
