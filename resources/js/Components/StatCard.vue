<script setup lang="ts">
  defineProps<{
    title: string;
    value: string;
    description: string;
    icon: string;
  }>();
</script>

<template>
  <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    <div class="flex items-start justify-between">
      <div>
        <div class="text-xs font-medium text-slate-400">
          {{ title }}
        </div>

        <div class="mt-2 text-2xl font-black text-[#073B4C]">
          {{ value }}
        </div>

        <div class="mt-2 text-xs text-slate-400">
          {{ description }}
        </div>
      </div>

      <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#06D6A0]/10 text-xl">
        {{ icon }}
      </div>
    </div>
  </div>
</template>
