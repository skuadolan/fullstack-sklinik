<script setup>
import { ref, computed, watch } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/24/solid';

import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot
} from '@headlessui/vue';

const props = defineProps({
  modelValue: {
    type: [Object, String, Number, null],
    default: null
  },
  items: {
    type: Array,
    required: true
  },
  labelKey: {
    type: String,
    default: 'name'
  },
  placeholder: {
    type: String,
    default: 'Pilih data'
  }
})

const emit = defineEmits(['update:modelValue'])

const queryItem = ref('');

const filteredItems = computed(() => {
  if (!queryItem.value) return props.items

  const q = queryItem.value.toLowerCase().replace(/\s+/g, '')

  return props.items.filter(item =>
    String(item[props.labelKey]).toLowerCase().replace(/\s+/g, '').includes(q)
  )
})

watch(() => props.modelValue, (val) => {
    queryItem.value = val ? val[props.labelKey] : ''
  },
  { immediate: true }
)
</script>

<template>
  <Combobox :modelValue="modelValue" @update:modelValue="emit('update:modelValue', $event)" nullable>
      <div class="relative mt-1">
          <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
            <ComboboxInput class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600  dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg" 
            @change="queryItem = $event.target.value" :displayValue="(search) => search?.name" />

            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>
          </div>
          
          <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0" @after-leave="queryItem = ''">
            <ComboboxOptions class="absolute z-[9999] mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
              <div v-if="filteredItems.length === 0 && queryItem !== ''" class="relative cursor-default select-none px-4 py-2 text-gray-700">
                  Tidak ditemukan.
              </div>

              <ComboboxOption v-for="search in filteredItems" as="template" :key="search.id" :value="search" v-slot="{ selected, active }">
                <li class="relative cursor-pointer select-none py-2 pl-10 pr-4" :class="{
                    'bg-teal-600 text-white': active,
                    'text-gray-900': !active,
                }">
                  <span class="block truncate" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                      {{ search.name }}
                  </span>

                  <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{ 'text-white': active, 'text-teal-600': !active }">
                      <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </TransitionRoot>
      </div>
  </Combobox>
</template>
