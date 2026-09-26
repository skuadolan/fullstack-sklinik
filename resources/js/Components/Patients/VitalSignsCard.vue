<script setup lang="ts">
  import type { VitalSigns } from '@/Stores/dummy/type';

  defineProps<{
    vitalSigns: VitalSigns;
  }>();
</script>

<template>
  <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
    <div class="rounded-2xl bg-red-50 p-4">
      <div class="text-xs text-red-400">Tekanan Darah</div>

      <div class="mt-2 text-xl font-black text-red-700">{{ vitalSigns.systolic }}/{{ vitalSigns.diastolic }}</div>

      <div class="text-[11px] text-red-400">mmHg</div>
    </div>

    <div class="rounded-2xl bg-orange-50 p-4">
      <div class="text-xs text-orange-400">Suhu</div>

      <div class="mt-2 text-xl font-black text-orange-700">{{ vitalSigns.temperature }}°C</div>
    </div>

    <div class="rounded-2xl bg-pink-50 p-4">
      <div class="text-xs text-pink-400">Heart Rate</div>

      <div class="mt-2 text-xl font-black text-pink-700">
        {{ vitalSigns.heartRate }}
      </div>

      <div class="text-[11px] text-pink-400">bpm</div>
    </div>

    <div class="rounded-2xl bg-[#06D6A0]/10 p-4">
      <div class="text-xs text-[#087F6C]">SpO₂</div>

      <div class="mt-2 text-xl font-black text-[#087F6C]">{{ vitalSigns.oxygenSaturation }}%</div>
    </div>
  </div>
</template>
