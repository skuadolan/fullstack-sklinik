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
                        <div class="w-full flex">
                            <div class="w-1/2 flex flex-wrap">
                                <form id="search" onsubmit="">
                                    <style>
                                        td {
                                            border: none !important;
                                        }
                                    </style>
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="golongan_darah"
                                                    class="block text-gray-700 text-sm font-medium mb-2 w-fit">
                                                    {{ __('Nama') }}
                                                </label>
                                            </td>
                                            <td>:</td>
                                            <td><x-autocomplete-layout section="jquery" get="golongan_darah" /></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-layout>
