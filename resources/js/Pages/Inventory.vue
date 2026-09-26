<script setup lang="ts">
  import { computed, ref } from 'vue';
  import { inventory, formatRupiah } from '@/Stores/dummy/data';

  const search = ref('');

  const filteredInventory = computed(() => {
    const keyword = search.value.toLowerCase();

    return inventory.filter((item) => item.name.toLowerCase().includes(keyword) || item.code.toLowerCase().includes(keyword) || item.category.toLowerCase().includes(keyword));
  });

  function statusLabel(status: string) {
    if (status === 'available') return 'Tersedia';
    if (status === 'low') return 'Stok Menipis';
    return 'Habis';
  }
</script>

<template>
  <div class="mx-auto max-w-7xl">
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
      <div>
        <h2 class="text-3xl font-black text-[#073B4C]">Inventory</h2>

        <p class="mt-2 text-slate-500">Pantau obat dan alat kesehatan klinik.</p>
      </div>

      <button class="rounded-xl bg-[#06D6A0] px-5 py-3 text-sm font-bold text-[#073B4C]">+ Tambah Item</button>
    </div>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
      <div class="border-b border-slate-100 p-5">
        <input
          v-model="search"
          type="text"
          placeholder="Cari item..."
          class="w-full max-w-md rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-[#06D6A0]"
        />
      </div>

      <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] text-left">
          <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-400">
            <tr>
              <th class="px-6 py-4">Item</th>
              <th class="px-6 py-4">Kategori</th>
              <th class="px-6 py-4">Stok</th>
              <th class="px-6 py-4">Harga</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">
            <tr
              v-for="item in filteredInventory"
              :key="item.id"
            >
              <td class="px-6 py-4">
                <div class="font-bold text-[#073B4C]">
                  {{ item.name }}
                </div>

                <div class="mt-1 text-xs text-slate-400">
                  {{ item.code }}
                </div>
              </td>

              <td class="px-6 py-4 text-sm text-slate-500">
                {{ item.category }}
              </td>

              <td class="px-6 py-4">
                <span class="font-bold">
                  {{ item.stock }}
                </span>

                <span class="ml-1 text-xs text-slate-400">
                  {{ item.unit }}
                </span>
              </td>

              <td class="px-6 py-4 text-sm">
                {{ formatRupiah(item.price) }}
              </td>

              <td class="px-6 py-4">
                <span
                  :class="[
                    'rounded-lg px-2.5 py-1 text-xs font-bold',
                    item.status === 'available' ? 'bg-green-50 text-green-600' : item.status === 'low' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-600',
                  ]"
                >
                  {{ statusLabel(item.status) }}
                </span>
              </td>

              <td class="px-6 py-4 text-right">
                <button class="text-xs font-bold text-[#1B9AAA]">Detail</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
