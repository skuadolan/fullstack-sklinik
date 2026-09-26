<script setup lang="ts">
  import { computed } from 'vue';
  import { invoices, patients, formatRupiah } from '@/Stores/dummy/data';

  function getPatientName(patientId: number) {
    return patients.find((patient) => patient.id === patientId)?.name ?? '-';
  }

  const totalRevenue = computed(() => invoices.filter((invoice) => invoice.status === 'paid').reduce((sum, invoice) => sum + invoice.total, 0));

  const pendingRevenue = computed(() => invoices.filter((invoice) => invoice.status === 'pending').reduce((sum, invoice) => sum + invoice.total, 0));
</script>

<template>
  <div class="mx-auto max-w-7xl">
    <div>
      <h2 class="text-3xl font-black text-[#073B4C]">Billing & Payment</h2>

      <p class="mt-2 text-slate-500">Kelola tagihan dan pembayaran pasien.</p>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2">
      <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <div class="text-sm text-slate-400">Total pembayaran</div>

        <div class="mt-2 text-3xl font-black text-[#073B4C]">
          {{ formatRupiah(totalRevenue) }}
        </div>

        <div class="mt-2 text-xs text-green-600">Sudah dibayar</div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <div class="text-sm text-slate-400">Menunggu pembayaran</div>

        <div class="mt-2 text-3xl font-black text-[#073B4C]">
          {{ formatRupiah(pendingRevenue) }}
        </div>

        <div class="mt-2 text-xs text-yellow-600">Pending</div>
      </div>
    </div>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
      <div class="border-b border-slate-100 px-6 py-5">
        <h3 class="font-bold text-[#073B4C]">Invoice</h3>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] text-left">
          <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-400">
            <tr>
              <th class="px-6 py-4">Invoice</th>
              <th class="px-6 py-4">Pasien</th>
              <th class="px-6 py-4">Tanggal</th>
              <th class="px-6 py-4">Total</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">
            <tr
              v-for="invoice in invoices"
              :key="invoice.id"
            >
              <td class="px-6 py-4">
                <div class="font-bold text-[#073B4C]">
                  {{ invoice.invoiceNumber }}
                </div>
              </td>

              <td class="px-6 py-4 text-sm">
                {{ getPatientName(invoice.patientId) }}
              </td>

              <td class="px-6 py-4 text-sm text-slate-500">
                {{ invoice.date }}
              </td>

              <td class="px-6 py-4 font-bold">
                {{ formatRupiah(invoice.total) }}
              </td>

              <td class="px-6 py-4">
                <span
                  :class="[
                    'rounded-lg px-2.5 py-1 text-xs font-bold',
                    invoice.status === 'paid' ? 'bg-green-50 text-green-600' : invoice.status === 'pending' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-600',
                  ]"
                >
                  {{ invoice.status === 'paid' ? 'Lunas' : invoice.status === 'pending' ? 'Pending' : 'Dibatalkan' }}
                </span>
              </td>

              <td class="px-6 py-4 text-right">
                <button class="text-xs font-bold text-[#1B9AAA]">Lihat</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
