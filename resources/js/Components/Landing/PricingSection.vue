<script setup lang="ts">
  import { Link } from '@inertiajs/vue3';

  const plans = [
    {
      name: 'Gratis',
      price: 'Rp0',
      description: 'Untuk mencoba Rekamin Pasien.',
      features: ['Manajemen pasien', 'Rekam medis', 'TTV', 'Resep', 'Inventory', 'Billing'],
      featured: false,
    },
    {
      name: 'Pro',
      price: 'Mulai Rp99rb',
      description: 'Untuk klinik yang membutuhkan operasional tanpa iklan.',
      features: ['Semua fitur Gratis', 'Tanpa iklan', 'Cloud storage', 'Laporan klinik', 'Multi-user', 'Support'],
      featured: true,
    },
    {
      name: 'Private',
      price: 'Custom',
      description: 'Aplikasi pribadi dengan domain dan deployment sendiri.',
      features: ['Private deployment', 'Custom domain', 'Custom branding', 'Database terisolasi', 'Custom feature', 'Priority support'],
      featured: false,
    },
  ];
</script>

<template>
  <section
    id="harga"
    class="bg-white py-24"
  >
    <div class="mx-auto max-w-7xl px-6">
      <div class="mx-auto max-w-2xl text-center">
        <div class="text-sm font-bold uppercase tracking-widest text-[#1B9AAA]">Pricing</div>

        <h2 class="mt-3 text-4xl font-black text-[#073B4C]">Mulai sesuai kebutuhan</h2>

        <p class="mt-5 text-slate-500">Gunakan versi gratis untuk mencoba, lalu berkembang sesuai kebutuhan klinik.</p>
      </div>

      <div class="mt-14 grid gap-6 lg:grid-cols-3">
        <div
          v-for="plan in plans"
          :key="plan.name"
          :class="['rounded-3xl border p-8', plan.featured ? 'border-[#06D6A0] bg-[#073B4C] text-white shadow-xl shadow-[#06D6A0]/10' : 'border-slate-200 bg-white']"
        >
          <div :class="['text-sm font-bold', plan.featured ? 'text-[#06D6A0]' : 'text-[#1B9AAA]']">
            {{ plan.name }}
          </div>

          <div class="mt-5 text-3xl font-black">
            {{ plan.price }}
          </div>

          <p :class="['mt-3 text-sm leading-6', plan.featured ? 'text-white/60' : 'text-slate-500']">
            {{ plan.description }}
          </p>

          <ul class="mt-8 space-y-4">
            <li
              v-for="feature in plan.features"
              :key="feature"
              class="flex gap-3 text-sm"
            >
              <span class="text-[#06D6A0]">✓</span>
              <span>{{ feature }}</span>
            </li>
          </ul>

          <Link
            href="/demo"
            :class="['mt-8 block rounded-xl px-5 py-3 text-center text-sm font-bold', plan.featured ? 'bg-[#06D6A0] text-[#073B4C]' : 'bg-[#F8FFE5] text-[#073B4C]']"
          >
            Coba Sekarang
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>
