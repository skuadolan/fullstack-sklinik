<x-card-box-shadow-layout>
    <form id="registerForm" onsubmit="submitForm('registerForm')">
        @csrf
        <input type="hidden" name="_token" id="_csrf-token" />
        <input type="hidden" name="token" id="csrf-token" />

        <div>
            <x-input-label for="company_name" :value="__('Nama Klinik')" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('name')"
                required autofocus autocomplete="company_name" />
            <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_company_name">
                <li></li>
            </ul>
        </div>

        <div>
            <x-input-label for="id_provinsi" :value="__('Provinsi')" />
            <x-text-input id="id_provinsi" class="block mt-1 w-full" type="text" name="id_provinsi" :value="old('name')"
                required autofocus autocomplete="id_provinsi" />
            <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_id_provinsi">
                <li></li>
            </ul>
        </div>

        <div>
            <x-input-label for="id_kabupaten" :value="__('Kabupaten')" />
            <x-text-input id="id_kabupaten" class="block mt-1 w-full" type="text" name="id_kabupaten" :value="old('name')"
                required autofocus autocomplete="id_kabupaten" />
            <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_id_kabupaten">
                <li></li>
            </ul>
        </div>

        <div>
            <x-input-label for="id_kecamatan" :value="__('Kecamatan')" />
            <x-text-input id="id_kecamatan" class="block mt-1 w-full" type="text" name="id_kecamatan" :value="old('name')"
                required autofocus autocomplete="id_kecamatan" />
            <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_id_kecamatan">
                <li></li>
            </ul>
        </div>

        <div>
            <x-input-label for="id_kelurahan" :value="__('Kelurahan')" />
            <x-text-input id="id_kelurahan" class="block mt-1 w-full" type="text" name="id_kelurahan" :value="old('name')"
                required autofocus autocomplete="id_kelurahan" />
            <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_id_kelurahan">
                <li></li>
            </ul>
        </div>

        <div class="flex items-center justify-end mt-4">
            <p class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer"
                onclick="openSection('loginSection')">
                {{ __('Sudah terdaftar?') }}
            </p>

            <x-primary-button class="hideBtnProcess ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-card-box-shadow-layout>
