<template>
  <section
    id="cara-kerja"
    class="bg-[#073B4C] py-24 text-white"
  >
    <div class="mx-auto max-w-7xl px-6">
      <div class="max-w-2xl">
        <div class="text-sm font-bold uppercase tracking-widest text-[#06D6A0]">Workflow</div>

        <h2 class="mt-3 text-4xl font-black">Alur pasien yang sederhana</h2>

        <p class="mt-5 leading-7 text-white/60">Rekamin Pasien dirancang mengikuti proses kerja klinik, bukan memaksa tenaga kesehatan mengikuti software.</p>
      </div>

      <div class="mt-16 grid gap-6 md:grid-cols-4">
        <div
          v-for="(step, index) in [
            ['01', 'Pendaftaran', 'Pasien didaftarkan dan data dasar tersimpan.'],
            ['02', 'Pemeriksaan', 'Dokter mencatat keluhan, TTV, diagnosis, dan tindakan.'],
            ['03', 'Resep & Billing', 'Resep dibuat dan biaya pemeriksaan dihitung otomatis.'],
            ['04', 'Riwayat', 'Seluruh riwayat pasien dapat dilihat kembali.'],
          ]"
          :key="step[0]"
          class="relative rounded-3xl border border-white/10 bg-white/5 p-7"
        >
          <div class="text-sm font-black text-[#06D6A0]">
            {{ step[0] }}
          </div>

          <h3 class="mt-6 text-xl font-bold">
            {{ step[1] }}
          </h3>

          <p class="mt-3 text-sm leading-6 text-white/60">
            {{ step[2] }}
          </p>

          <div
            v-if="index < 3"
            class="absolute -right-3 top-1/2 hidden h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-[#06D6A0] text-[#073B4C] md:flex"
          >
            →
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
