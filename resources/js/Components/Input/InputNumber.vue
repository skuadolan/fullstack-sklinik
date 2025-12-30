<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  modelValue: {
    type: Number,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

function onInput(e) {
  const onlyNumbers = e.target.value.replace(/[^0-9]/g, '')
  e.target.value = onlyNumbers
  emit('update:modelValue', onlyNumbers)
}
</script>

<template>
    <input
    @input="onInput"
    class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600   dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg" />
</template>
