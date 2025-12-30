<script setup>
import { ref } from 'vue'
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/24/solid';

const JKelamin = [
    { id: "L", name: 'Laki - Laki' },
    { id: "P", name: 'Perempuan' },
]
const selectedJKelamin = ref(JKelamin[0])
</script>

<template>
    <Listbox v-model="selectedJKelamin">
        <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
            <ListboxButton id="jenis_kelamin" class="block w-full border cursor-pointer disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600  dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg text-justify">
                {{ selectedJKelamin.name }}

                <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </div>
            </ListboxButton>
            <input type="hidden" name="jenis_kelamin" :value="selectedJKelamin.id" />
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-out" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <ListboxOptions class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                <ListboxOption class="relative cursor-default select-none py-2" v-for="jKelamin in JKelamin" :key="jKelamin.id" :value="jKelamin" v-slot="{ selected, active }">
                    <li class="relative cursor-pointer select-none py-2 pl-10 pr-4" :class="{
                        'bg-teal-600 text-white': active,
                        'text-gray-900': !active,
                    }">
                        <span class="block truncate" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                            {{ jKelamin.name }}
                        </span>
                        <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{ 'text-white': active, 'text-teal-600': !active }">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ListboxOption>
            </ListboxOptions>
        </transition>
    </Listbox>
</template>