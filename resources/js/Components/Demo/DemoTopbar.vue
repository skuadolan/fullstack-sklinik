<script setup lang="ts">
  import { computed } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const title = computed(() => {
    if (route.name === 'demo.patients') return 'Pasien';
    if (route.name === 'demo.patient-detail') return 'Detail Pasien';
    if (route.name === 'demo.inventory') return 'Inventory';
    if (route.name === 'demo.billing') return 'Billing';
    return 'Dashboard';
  });
</script>

<template>
  <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="flex h-20 items-center justify-between px-4 md:px-8">
      <div>
        <div class="text-xs text-slate-400">Rekamin Pasien / Demo</div>

        <h1 class="mt-1 text-xl font-black text-[#073B4C]">
          {{ title }}
        </h1>
      </div>

      <div class="flex items-center gap-3">
        <button class="hidden rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-500 hover:bg-slate-50 md:block">🔔</button>

        <div class="flex items-center gap-3 rounded-xl bg-slate-50 px-3 py-2">
          <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#06D6A0] font-bold text-[#073B4C]">A</div>

          <div class="hidden text-sm md:block">
            <div class="font-bold text-[#073B4C]">dr. Andika</div>

            <div class="text-xs text-slate-400">Administrator</div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
