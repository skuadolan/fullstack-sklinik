<x-card-box-shadow-layout>
    <form id="registerForm" onsubmit="submitForm('registerForm')">
        @csrf
        <input type="hidden" name="token" id="csrf-token" />

        <div id="clientRegist">
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Klinik<span class="text-red-500">*</span>
                </label>
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" autofocus />
                <ul class="hide_notif text-sm text-red-600 space-y-1 mt-2" id="err_company_name">
                    <li></li>
                </ul>
            </div>

            <div>
                <label for="id_provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                    Provinsi<span class="text-red-500">*</span>
                </label>
                <x-autocomplete-layout section="ssr-dropdown" get="provinsi" placeholder="Pilih provinsi..." />
            </div>

            <div>
                <label for="id_kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                    Kabupaten<span class="text-red-500">*</span>
                </label>
                <x-autocomplete-layout section="ssr-dropdown" get="kabupaten" placeholder="Pilih kabupaten..." onclick="DropdownGetLoad('kabupaten', 'provinsi')" />
            </div>

            <div>
                <label for="id_kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Kecamatan<span class="text-red-500">*</span>
                </label>
                <x-autocomplete-layout section="ssr-dropdown" get="kecamatan" placeholder="Pilih kecamatan..." onclick="DropdownGetLoad('kecamatan', 'kabupaten')" />
            </div>

            <div>
                <label for="id_kelurahan" class="block text-sm font-medium text-gray-700 mb-2">
                    Kelurahan<span class="text-red-500">*</span>
                </label>
                <x-autocomplete-layout section="ssr-dropdown" get="kelurahan" placeholder="Pilih kelurahan..." onclick="DropdownGetLoad('kelurahan', 'kecamatan')" />
            </div>
        </div>

        <div id="userRegist">
            <div>
                <x-input-label for="fullname" :value="__('Nama Lengkap *')" />
                <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username *')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email *')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password *')" />

                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password *')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <p class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer"
                onclick="openSection('loginSection')">
                {{ __('Sudah terdaftar?') }}
            </p>

            <x-btn-customize-layout id="nextRegist" section="success" class="ms-4" onclick="registSection('userRegist')">
                {{ __('Lanjutkan') }}
            </x-btn-customize-layout>

            <x-secondary-button class="submitRegistSection ms-4" onclick="registSection('clientRegist')">
                {{ __('Kembali') }}
            </x-secondary-button>

            <x-btn-customize-layout class="submitRegistSection ms-4" section="primary">
                {{ __('Simpan') }}
            </x-btn-customize-layout>
        </div>
    </form>

    <script>
        $(document).ready(async function() {
            $("#userRegist").hide();
            $(".submitRegistSection").hide();
        });

        // FUNCTION ON CLICK ON CLICK START
        function registSection($sections) {
            if ($sections == 'clientRegist') {
                $(".submitRegistSection").hide();
                $("#userRegist").hide();
                $("#nextRegist").show();
                $("#clientRegist").show();
            }

            if ($sections == 'userRegist') {
                $("#nextRegist").hide();
                $("#clientRegist").hide();
                $("#userRegist").show();
                $(".submitRegistSection").show();
            }
        }

        async function DropdownGetLoad($get, $from) {
            const $idFrom = $(`#id_${$from}`).val();
            if (IsValidVal($idFrom)) {
                const $params = `&id_${$from}=${$idFrom}`
                await DropdownContentLoader(`/api/search?get_data=${$get}${$params}`, $get);
            }
        }
        // FUNCTION ON CLICK ON CLICK END
    </script>
</x-card-box-shadow-layout>
