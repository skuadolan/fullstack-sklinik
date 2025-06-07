<x-dynamic-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelaksanaan Pelayanan') }}
        </h2>
    </x-slot>

    @php
        dd($dataPasienKunjungan);
    @endphp

    <div class="w-full py-12">
        <div class="shadow max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="p-6 text-gray-900">
                    <fieldset>
                        <legend class="text-xl font-semibold text-gray-800">
                            {{ __('Data Pasien') }}
                        </legend>
                        <div class="w-full flex mb-4">
                            <div class="w-full sm:w-1/2 flex flex-wrap">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(async function() {
            (async function() {
                // Load After Component Created START
                setTimeout(async() => {
                }, 100);
                // Load After Component Created END
            })();
        });

        // Function On CLICK START
        // Function On CLICK END
    </script>
</x-dynamic-layout>
