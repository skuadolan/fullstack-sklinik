<script setup lang="ts">
  import { ref } from 'vue';
  import { Link } from '@inertiajs/vue3';

  const open = ref(false);
</script>

<template>
  <header class="sticky top-0 z-50 border-b border-white/60 bg-[#F8FFE5]/80 backdrop-blur-xl">
    <div class="mx-auto flex h-18 max-w-7xl items-center justify-between px-6">
      <Link
        to="/"
        class="flex items-center gap-3"
      >
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#06D6A0] text-[#073B4C] shadow-sm">
          <svg
            class="h-5 w-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 19V5m0 0h11l-2 4 2 4H4"
            />
          </svg>
        </div>

        <div>
          <div class="font-bold tracking-tight text-[#073B4C]">Rekamin Pasien</div>

          <div class="text-[10px] font-medium uppercase tracking-widest text-[#1B9AAA]">Clinic Management</div>
        </div>
      </Link>

      <nav class="hidden items-center gap-8 text-sm font-medium md:flex">
        <a
          href="#fitur"
          class="hover:text-[#1B9AAA]"
        >
          Fitur
        </a>

        <a
          href="#cara-kerja"
          class="hover:text-[#1B9AAA]"
        >
          Cara Kerja
        </a>

        <a
          href="#harga"
          class="hover:text-[#1B9AAA]"
        >
          Harga
        </a>
      </nav>

      <div class="hidden items-center gap-3 md:flex">
        <Link
          href="/demo"
          class="rounded-xl px-4 py-2.5 text-sm font-semibold text-[#073B4C] hover:bg-white"
        >
          Lihat Demo
        </Link>

        <Link
          href="/demo"
          class="rounded-xl bg-[#06D6A0] px-5 py-2.5 text-sm font-bold text-[#073B4C] shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
        >
          Coba Gratis
        </Link>
      </div>

      <button
        class="rounded-xl p-2 md:hidden"
        @click="open = !open"
      >
        <svg
          class="h-6 w-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            v-if="!open"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />

          <path
            v-else
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
    </div>

    <div
      v-if="open"
      class="border-t border-slate-200 bg-white px-6 py-5 md:hidden"
    >
      <nav class="flex flex-col gap-4 text-sm font-medium">
        <a
          href="#fitur"
          @click="open = false"
        >
          Fitur
        </a>

        <a
          href="#cara-kerja"
          @click="open = false"
        >
          Cara Kerja
        </a>

        <a
          href="#harga"
          @click="open = false"
        >
          Harga
        </a>

        <Link
          href="/demo"
          class="rounded-xl bg-[#06D6A0] px-4 py-3 text-center font-bold text-[#073B4C]"
        >
          Coba Demo
        </Link>
      </nav>
    </div>
  </header>
</template>
