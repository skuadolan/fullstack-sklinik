@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
    $alignmentClasses = match ($align) {
        'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
        'top' => 'origin-top',
        default => 'ltr:origin-top-right rtl:origin-top-left end-0',
    };

    $width = match ($width) {
        '48' => 'w-48',
        default => $width,
    };
@endphp

<div class="relative content-center" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
        style="display: none;">
        {{-- @click="open = false"> --}}
        <div x-data="{ search: '' }"
            class="flex flex-wrap justify-start fixed left-0 z-10 w-full mt-2 bg-white rounded-md shadow-lg {{ $contentClasses }}">
            <!-- Search Input -->
            <div class="p-2 flex justify-center w-full">
                <x-autocomplete-layout section="" get="" x-model="search" type="text"
                    placeholder="Search..."
                    class="w-full px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <ul class="flex flex-wrap gap-10 max-h-80 overflow-x-auto">
                @if (isset($listMenu) && !empty($listMenu))
                    @foreach ($listMenu as $list)
                        <li x-show="!search || '{{ $list->name }}'.toLowerCase().includes(search.toLowerCase())"
                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex flex-wrap justify-center text-center items-center text-pretty w-24"
                            onclick="OpenLink('{{ $list->link }}', 'self')">
                            <div class="w-full flex justify-center ">
                                <div class="w-10">
                                    <img src="{{ url("$list->icon") }}" alt="{{ $list->name }}"
                                        srcset="{{ url("$list->icon") }}" />
                                </div>
                            </div>
                            {{ $list->name }}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
