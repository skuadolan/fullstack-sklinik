<script setup lang="ts">
  import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="relative overflow-hidden">
    <div class="absolute -right-40 -top-40 h-96 w-96 rounded-full bg-[#06D6A0]/20 blur-3xl" />
    <div class="absolute -left-40 bottom-0 h-96 w-96 rounded-full bg-[#1B9AAA]/15 blur-3xl" />

    <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-6 py-20 md:grid-cols-2 md:py-28">
      <div>
        <div
          class="mb-6 inline-flex items-center gap-2 rounded-full border border-[#06D6A0]/30 bg-white/70 px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#1B9AAA]"
        >
          <span class="h-2 w-2 rounded-full bg-[#06D6A0]" />
          Clinic Management Platform
        </div>

        <h1 class="max-w-3xl text-5xl font-black leading-[1.05] tracking-tight text-[#073B4C] md:text-7xl">
          Rekam pasien.
          <span class="text-[#06D6A0]"> Lebih sederhana. </span>
        </h1>

        <p class="mt-7 max-w-xl text-lg leading-8 text-slate-600">
          Kelola pendaftaran, rekam medis, TTV, resep, inventori, billing, dan pembayaran klinik dalam satu aplikasi.
        </p>

        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
          <Link
            href="/demo"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#06D6A0] px-6 py-4 font-bold text-[#073B4C] shadow-lg shadow-[#06D6A0]/20 transition hover:-translate-y-1"
          >
            Coba Demo Gratis

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
                d="M13 7l5 5m0 0l-5 5m5-5H6"
              />
            </svg>
          </Link>

          <a
            href="#fitur"
            class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white/70 px-6 py-4 font-bold text-[#073B4C] hover:bg-white"
          >
            Lihat Fitur
          </a>
        </div>

        <div class="mt-8 flex flex-wrap gap-5 text-sm text-slate-500">
          <span>✓ Tanpa instalasi</span>
          <span>✓ Cloud ready</span>
          <span>✓ Data terstruktur</span>
        </div>
      </div>

      <div class="relative">
        <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-br from-[#06D6A0]/20 to-[#1B9AAA]/10 blur-2xl" />

        <div class="relative overflow-hidden rounded-[2rem] border border-white bg-white shadow-2xl">
          <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <div>
              <div class="text-xs font-medium text-slate-400">Dashboard Klinik</div>

              <div class="font-bold text-[#073B4C]">Selamat pagi, dr. Andika</div>
            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#06D6A0]/20 text-[#1B9AAA]">👨‍⚕️</div>
          </div>

          <div class="grid grid-cols-2 gap-4 bg-slate-50 p-5">
            <div class="rounded-2xl bg-white p-4">
              <div class="text-xs text-slate-400">Pasien hari ini</div>

              <div class="mt-2 text-3xl font-black text-[#073B4C]">24</div>

              <div class="mt-2 text-xs font-semibold text-[#06A77D]">+12% minggu ini</div>
            </div>

            <div class="rounded-2xl bg-white p-4">
              <div class="text-xs text-slate-400">Pendapatan</div>

              <div class="mt-2 text-xl font-black text-[#073B4C]">Rp2,8jt</div>

              <div class="mt-2 text-xs font-semibold text-[#06A77D]">Hari ini</div>
            </div>

            <div class="col-span-2 rounded-2xl bg-[#073B4C] p-5 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <div class="text-xs text-white/50">Antrian berikutnya</div>

                  <div class="mt-2 font-bold">Ahmad Fauzan</div>

                  <div class="mt-1 text-xs text-white/60">RM-2026-0001 · 09:30</div>
                </div>

                <div class="rounded-xl bg-[#06D6A0] px-3 py-2 text-xs font-bold text-[#073B4C]">Pemeriksaan</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
