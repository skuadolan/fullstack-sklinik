<script setup lang="ts">
  import { useRoute } from 'vue-router';
  import { Link } from '@inertiajs/vue3';

  const route = useRoute();

  const menus = [
    {
      label: 'Dashboard',
      path: '/demo',
      icon: '▦',
    },
    {
      label: 'Pasien',
      path: '/demo/patients',
      icon: '♙',
    },
    {
      label: 'Inventory',
      path: '/demo/inventory',
      icon: '▣',
    },
    {
      label: 'Billing',
      path: '/demo/billing',
      icon: '▤',
    },
  ];
</script>

<template>
  <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-slate-200 bg-[#073B4C] lg:block">
    <div class="flex h-full flex-col">
      <div class="flex h-20 items-center gap-3 px-6">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#06D6A0] font-black text-[#073B4C]">R</div>

        <div>
          <div class="font-bold text-white">Rekamin Pasien</div>

          <div class="text-[10px] uppercase tracking-widest text-white/40">Demo Clinic</div>
        </div>
      </div>

      <div class="px-4 pt-6">
        <div class="px-3 pb-3 text-[10px] font-bold uppercase tracking-widest text-white/30">Menu utama</div>

        <nav class="space-y-1">
          <Link
            v-for="menu in menus"
            :key="menu.path"
            href="menu.path"
            :class="[
              'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition',
              route.path === menu.path ? 'bg-[#06D6A0] text-[#073B4C]' : 'text-white/60 hover:bg-white/5 hover:text-white',
            ]"
          >
            <span class="w-5 text-center">
              {{ menu.icon }}
            </span>

            {{ menu.label }}
          </Link>
        </nav>
      </div>

      <div class="mt-auto p-4">
        <div class="rounded-2xl bg-white/5 p-4">
          <div class="text-xs text-white/40">Demo account</div>

          <div class="mt-2 font-bold text-white">dr. Andika</div>

          <div class="mt-1 text-xs text-white/40">Administrator</div>
        </div>

        <Link
          to="/"
          class="mt-3 flex items-center gap-2 px-3 py-3 text-sm text-white/50 hover:text-white"
        >
          ← Kembali ke website
        </Link>
      </div>
    </div>
  </aside>
</template>
