<script setup lang="ts">
  const features = [
    {
      title: 'Rekam Medis',
      description: 'Riwayat pemeriksaan, diagnosis, tindakan, catatan dokter, dan data klinis tersusun rapi.',
      icon: '📋',
    },
    {
      title: 'TTV Terintegrasi',
      description: 'Tekanan darah, suhu, nadi, respirasi, SpO₂, berat dan tinggi badan.',
      icon: '❤️',
    },
    {
      title: 'Resep & Obat',
      description: 'Buat resep dan hubungkan dengan stok obat klinik secara terstruktur.',
      icon: '💊',
    },
    {
      title: 'Inventory',
      description: 'Pantau stok obat dan alat kesehatan serta peringatan stok minimum.',
      icon: '📦',
    },
    {
      title: 'Billing',
      description: 'Kelola tagihan pasien, pembayaran, invoice, dan metode pembayaran.',
      icon: '💳',
    },
    {
      title: 'Patient Portal',
      description: 'Pasien dapat melakukan pendaftaran dan melihat riwayat medis mereka.',
      icon: '👤',
    },
  ];
</script>

<template>
  <section
    id="fitur"
    class="bg-white py-24"
  >
    <div class="mx-auto max-w-7xl px-6">
      <div class="mx-auto max-w-2xl text-center">
        <div class="text-sm font-bold uppercase tracking-widest text-[#1B9AAA]">Semua yang dibutuhkan</div>

        <h2 class="mt-3 text-4xl font-black tracking-tight text-[#073B4C]">Satu sistem untuk operasional klinik</h2>

        <p class="mt-5 leading-7 text-slate-500">Dari pasien datang sampai pembayaran selesai, semuanya berada dalam satu alur kerja.</p>
      </div>

      <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="feature in features"
          :key="feature.title"
          class="group rounded-3xl border border-slate-100 bg-[#F8FFE5]/60 p-7 transition hover:-translate-y-1 hover:border-[#06D6A0]/30 hover:bg-white hover:shadow-xl"
        >
          <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
            {{ feature.icon }}
          </div>

          <h3 class="mt-6 text-xl font-bold text-[#073B4C]">
            {{ feature.title }}
          </h3>

          <p class="mt-3 leading-7 text-slate-500">
            {{ feature.description }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
