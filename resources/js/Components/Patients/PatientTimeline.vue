<script setup lang="ts">
  import type { MedicalVisit } from '@/Stores/dummy/type';

  defineProps<{
    visits: MedicalVisit[];
  }>();
</script>

<template>
  <div class="space-y-6">
    <div
      v-for="visit in visits"
      :key="visit.id"
      class="relative pl-8"
    >
      <div class="absolute left-0 top-1 h-4 w-4 rounded-full border-4 border-[#06D6A0] bg-white" />

      <div class="absolute left-[7px] top-5 h-full w-px bg-slate-200 last:hidden" />

      <div class="rounded-2xl border border-slate-200 bg-white p-5">
        <div class="flex flex-col justify-between gap-2 md:flex-row">
          <div>
            <div class="text-xs font-medium text-slate-400">
              {{ visit.date }}
            </div>

            <h4 class="mt-1 font-bold text-[#073B4C]">
              {{ visit.diagnosis }}
            </h4>
          </div>

          <div class="text-sm text-slate-500">
            {{ visit.doctor }}
          </div>
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-3">
          <div>
            <div class="text-xs text-slate-400">Keluhan</div>

            <div class="mt-1 text-sm font-medium">
              {{ visit.complaint }}
            </div>
          </div>

          <div>
            <div class="text-xs text-slate-400">Tindakan</div>

            <div class="mt-1 text-sm font-medium">
              {{ visit.treatment }}
            </div>
          </div>

          <div>
            <div class="text-xs text-slate-400">Catatan</div>

            <div class="mt-1 text-sm font-medium">
              {{ visit.notes }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
