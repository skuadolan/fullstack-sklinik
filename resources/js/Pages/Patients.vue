<script setup lang="ts">
  import { computed, ref } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import { patients } from '@/Stores/dummy/data';

  const search = ref('');

  const filteredPatients = computed(() => {
    const keyword = search.value.toLowerCase().trim();

    if (!keyword) {
      return patients;
    }

    return patients.filter(
      (patient) => patient.name.toLowerCase().includes(keyword) || patient.medicalRecordNumber.toLowerCase().includes(keyword) || patient.phone.includes(keyword),
    );
  });

  function alert(params:string) {
    alert(params);
  }

</script>

<template>
  <div class="mx-auto max-w-7xl">
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
      <div>
        <h2 class="text-3xl font-black text-[#073B4C]">Pasien</h2>

        <p class="mt-2 text-slate-500">Kelola data dan rekam medis pasien.</p>
      </div>

      <button
        class="rounded-xl bg-[#06D6A0] px-5 py-3 text-sm font-bold text-[#073B4C]"
        @click="alert('Demo: form pasien baru akan dibuka.')"
      >
        + Tambah Pasien
      </button>
    </div>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
      <div class="border-b border-slate-100 p-5">
        <div class="relative max-w-md">
          <input
            v-model="search"
            type="text"
            placeholder="Cari nama, nomor RM, atau telepon..."
            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-[#06D6A0] focus:ring-2 focus:ring-[#06D6A0]/10"
          />
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left">
          <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-400">
            <tr>
              <th class="px-6 py-4">Pasien</th>
              <th class="px-6 py-4">No. RM</th>
              <th class="px-6 py-4">Gender</th>
              <th class="px-6 py-4">Gol. Darah</th>
              <th class="px-6 py-4">Kunjungan</th>
              <th class="px-6 py-4"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">
            <tr
              v-for="patient in filteredPatients"
              :key="patient.id"
              class="hover:bg-slate-50"
            >
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#06D6A0]/10 font-bold text-[#087F6C]">
                    {{ patient.name[0] }}
                  </div>

                  <div>
                    <div class="font-bold text-[#073B4C]">
                      {{ patient.name }}
                    </div>

                    <div class="text-xs text-slate-400">
                      {{ patient.phone }}
                    </div>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 text-sm font-medium">
                {{ patient.medicalRecordNumber }}
              </td>

              <td class="px-6 py-4 text-sm text-slate-500">
                {{ patient.gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
              </td>

              <td class="px-6 py-4">
                <span class="rounded-lg bg-red-50 px-2.5 py-1 text-xs font-bold text-red-600">
                  {{ patient.bloodType }}
                </span>
              </td>

              <td class="px-6 py-4 text-sm text-slate-500">
                {{ patient.lastVisit }}
              </td>

              <td class="px-6 py-4 text-right">
                <Link
                  :href="`/demo/patients/${patient.id}`"
                  class="rounded-lg px-3 py-2 text-xs font-bold text-[#1B9AAA] hover:bg-[#1B9AAA]/10"
                >
                  Detail →
                </Link>
              </td>
            </tr>

            <tr v-if="filteredPatients.length === 0">
              <td
                colspan="6"
                class="px-6 py-12 text-center text-sm text-slate-400"
              >
                Pasien tidak ditemukan.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
