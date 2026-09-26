<script setup lang="ts">
  import StatCard from '@/Components/StatCard.vue';
  import { Link } from '@inertiajs/vue3';
  import { patients, invoices, inventory } from '@/Stores/dummy/data';
  import { formatRupiah } from '@/Stores/dummy/data';

  const paidToday = invoices.filter((invoice) => invoice.status === 'paid').reduce((total, invoice) => total + invoice.total, 0);
</script>

<template>
  <div class="mx-auto max-w-7xl">
    <div class="mb-8">
      <div class="text-sm text-slate-400">Jumat, 25 September 2026</div>

      <h2 class="mt-1 text-3xl font-black text-[#073B4C]">Selamat pagi, dr. Andika 👋</h2>

      <p class="mt-2 text-slate-500">Berikut ringkasan aktivitas klinik hari ini.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
      <StatCard
        title="Pasien"
        :value="String(patients.length)"
        description="+12% dari minggu lalu"
        icon="👥"
      />

      <StatCard
        title="Pendapatan"
        :value="formatRupiah(paidToday)"
        description="Pembayaran hari ini"
        icon="💰"
      />

      <StatCard
        title="Stok Menipis"
        :value="String(inventory.filter((item) => item.status !== 'available').length)"
        description="Perlu diperhatikan"
        icon="📦"
      />

      <StatCard
        title="Menunggu Bayar"
        :value="String(invoices.filter((item) => item.status === 'pending').length)"
        description="Invoice pending"
        icon="⏳"
      />
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-3">
      <div class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
          <div>
            <h3 class="font-bold text-[#073B4C]">Pasien terbaru</h3>

            <p class="mt-1 text-xs text-slate-400">Aktivitas pasien terakhir</p>
          </div>

          <Link
            href="/demo/patients"
            class="text-xs font-bold text-[#1B9AAA]"
          >
            Lihat semua →
          </Link>
        </div>

        <div class="divide-y divide-slate-100">
          <div
            v-for="patient in patients.slice(0, 5)"
            :key="patient.id"
            class="flex items-center justify-between px-6 py-4"
          >
            <div class="flex items-center gap-3">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#06D6A0]/10 font-bold text-[#087F6C]">
                {{ patient.name[0] }}
              </div>

              <div>
                <div class="text-sm font-bold text-[#073B4C]">
                  {{ patient.name }}
                </div>

                <div class="text-xs text-slate-400">
                  {{ patient.medicalRecordNumber }}
                </div>
              </div>
            </div>

            <div class="text-xs text-slate-400">
              {{ patient.lastVisit }}
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-[#073B4C] p-6 text-white">
        <div class="text-sm font-bold">Quick Actions</div>

        <div class="mt-5 grid gap-3">
          <Link
            href="/demo/patients"
            class="rounded-xl bg-white/10 p-4 hover:bg-white/15"
          >
            <div class="font-bold">+ Tambah pasien</div>

            <div class="mt-1 text-xs text-white/50">Daftarkan pasien baru</div>
          </Link>

          <Link
            href="/demo/inventory"
            class="rounded-xl bg-white/10 p-4 hover:bg-white/15"
          >
            <div class="font-bold">📦 Cek inventory</div>

            <div class="mt-1 text-xs text-white/50">Periksa stok obat</div>
          </Link>

          <Link
            href="/demo/billing"
            class="rounded-xl bg-white/10 p-4 hover:bg-white/15"
          >
            <div class="font-bold">💳 Billing</div>

            <div class="mt-1 text-xs text-white/50">Lihat pembayaran</div>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
