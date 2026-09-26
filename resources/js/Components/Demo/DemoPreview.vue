<script setup lang="ts">
  import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="bg-[#F8FFE5] py-24">
    <div class="mx-auto max-w-7xl px-6">
      <div class="grid items-center gap-14 lg:grid-cols-2">
        <div>
          <div class="text-sm font-bold uppercase tracking-widest text-[#1B9AAA]">Live Demo</div>

          <h2 class="mt-3 text-4xl font-black tracking-tight text-[#073B4C]">Coba langsung sebelum memutuskan</h2>

          <p class="mt-5 leading-7 text-slate-600">Jelajahi dashboard, data pasien, rekam medis, resep, inventori, sampai billing menggunakan data dummy.</p>

          <Link
            href="/demo"
            class="mt-8 inline-flex rounded-2xl bg-[#06D6A0] px-6 py-4 font-bold text-[#073B4C] shadow-lg"
          >
            Buka Demo
          </Link>
        </div>

        <div class="rounded-[2rem] border border-white bg-white p-4 shadow-xl">
          <div class="rounded-[1.5rem] bg-slate-50 p-5">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-xs text-slate-400">Pasien terbaru</div>

                <div class="font-bold text-[#073B4C]">Hari ini</div>
              </div>

              <div class="rounded-xl bg-[#06D6A0]/20 px-3 py-2 text-xs font-bold text-[#087F6C]">24 pasien</div>
            </div>

            <div class="mt-5 space-y-3">
              <div
                v-for="patient in [
                  ['Ahmad Fauzan', 'RM-2026-0001', 'ISPA'],
                  ['Siti Rahma', 'RM-2026-0002', 'Cephalgia'],
                  ['Budi Santoso', 'RM-2026-0003', 'Common Cold'],
                ]"
                :key="patient[0]"
                class="flex items-center justify-between rounded-2xl bg-white p-4"
              >
                <div class="flex items-center gap-3">
                  <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#1B9AAA]/10 font-bold text-[#1B9AAA]">
                    {{ patient[0][0] }}
                  </div>

                  <div>
                    <div class="text-sm font-bold text-[#073B4C]">
                      {{ patient[0] }}
                    </div>

                    <div class="text-xs text-slate-400">
                      {{ patient[1] }}
                    </div>
                  </div>
                </div>

                <div class="text-xs font-medium text-slate-500">
                  {{ patient[2] }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
