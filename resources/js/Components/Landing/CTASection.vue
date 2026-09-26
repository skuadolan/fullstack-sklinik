<script setup lang="ts">
  import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="bg-[#F8FFE5] py-24">
    <div class="mx-auto max-w-5xl px-6">
      <div class="overflow-hidden rounded-[2rem] bg-[#06D6A0] px-8 py-14 text-center shadow-xl md:px-16">
        <div class="mx-auto max-w-2xl">
          <h2 class="text-4xl font-black tracking-tight text-[#073B4C]">Siap merapikan operasional klinik?</h2>

          <p class="mt-5 leading-7 text-[#073B4C]/70">Coba Rekamin Pasien dengan data demo dan lihat bagaimana alur klinik dapat dibuat lebih sederhana.</p>

          <Link
            :href="route('demo')"
            class="mt-8 inline-flex rounded-2xl bg-[#073B4C] px-7 py-4 font-bold text-white shadow-lg transition hover:-translate-y-1"
          >
            Coba Demo Gratis
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>
