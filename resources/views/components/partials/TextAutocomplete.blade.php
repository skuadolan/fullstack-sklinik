@if ($section == 'jquery' && !empty($get))
    @if ($get == 'provinsi')
        <div id="provinsi_autocomplete_container" class="relative">
            <div class="flex items-center">
                <x-text-input
                    {{ $attributes->merge(['id' => 'provinsi', 'name' => 'provinsi', 'type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none', 'placeholder' => 'Pilih provinsi...']) }} />
                <x-text-input {{ $attributes->merge(['id' => 'id_provinsi', 'name' => 'id_provinsi', 'type' => 'hidden']) }} />
                <span id="search-icon" class="absolute right-3">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <span id="loading-icon" class="absolute right-3 hidden">
                    <i class="fas fa-spinner fa-spin text-gray-500"></i>
                </span>
            </div>
        </div>
    @endif
    @if ($get == 'kabupaten')
        <div id="kabupaten_autocomplete_container" class="relative">
            <div class="flex items-center">
                <x-text-input
                    {{ $attributes->merge(['id' => 'kabupaten', 'name' => 'kabupaten', 'type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none', 'placeholder' => 'Pilih kabupaten...']) }} />
                <x-text-input {{ $attributes->merge(['id' => 'id_kabupaten', 'name' => 'id_kabupaten', 'type' => 'hidden']) }} />
                <span id="search-icon" class="absolute right-3">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <span id="loading-icon" class="absolute right-3 hidden">
                    <i class="fas fa-spinner fa-spin text-gray-500"></i>
                </span>
            </div>
        </div>
    @endif
    @if ($get == 'kecamatan')
        <div id="kecamatan_autocomplete_container" class="relative">
            <div class="flex items-center">
                <x-text-input
                    {{ $attributes->merge(['id' => 'kecamatan', 'name' => 'kecamatan', 'type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none', 'placeholder' => 'Pilih kecamatan...']) }} />
                <x-text-input {{ $attributes->merge(['id' => 'id_kecamatan', 'name' => 'id_kecamatan', 'type' => 'hidden']) }} />
                <span id="search-icon" class="absolute right-3">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <span id="loading-icon" class="absolute right-3 hidden">
                    <i class="fas fa-spinner fa-spin text-gray-500"></i>
                </span>
            </div>
        </div>
    @endif
    @if ($get == 'kelurahan')
        <div id="kelurahan_autocomplete_container" class="relative">
            <div class="flex items-center">
                <x-text-input
                    {{ $attributes->merge(['id' => 'kelurahan', 'name' => 'kelurahan', 'type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none', 'placeholder' => 'Pilih kelurahan...']) }} />
                <x-text-input {{ $attributes->merge(['id' => 'id_kelurahan', 'name' => 'id_kelurahan', 'type' => 'hidden']) }} />
                <span id="search-icon" class="absolute right-3">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <span id="loading-icon" class="absolute right-3 hidden">
                    <i class="fas fa-spinner fa-spin text-gray-500"></i>
                </span>
            </div>
        </div>
    @endif
    @if ($get == 'golongan_darah')
        <div id="golongan_darah_autocomplete_container" class="relative">
            <div class="flex items-center">
                <x-text-input
                    {{ $attributes->merge(['id' => 'golongan_darah', 'name' => 'golongan_darah', 'type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none', 'placeholder' => 'Cari golongan darah...']) }} />
                <x-text-input {{ $attributes->merge(['id' => 'id_golongan_darah', 'name' => 'id_golongan_darah', 'type' => 'hidden']) }} />
                <span id="search-icon" class="absolute right-3">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <span id="loading-icon" class="absolute right-3 hidden">
                    <i class="fas fa-spinner fa-spin text-gray-500"></i>
                </span>
            </div>
        </div>
    @endif
@endif

@if (empty($section))
<div id="autocomplete_container" class="relative">
    <div class="flex items-center">
        <x-text-input
            {{ $attributes->merge(['type' => 'text', 'class' => 'border rounded-lg w-full px-3 py-2 focus:outline-none']) }} />
        <span id="search-icon" class="absolute right-3">
            <i class="fas fa-search text-gray-500"></i>
        </span>
        <span id="loading-icon" class="absolute right-3 hidden">
            <i class="fas fa-spinner fa-spin text-gray-500"></i>
        </span>
    </div>
</div>
@endif
