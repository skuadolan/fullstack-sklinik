<script setup lang="ts">
  import { computed, ref } from 'vue';
  import { useRoute } from 'vue-router';
  import { Link } from '@inertiajs/vue3';

  import { getPatient, getPatientPrescriptions, getPatientVisits } from '@/Stores/dummy/data';

  import PatientTimeline from '@/Components/Patients/PatientTimeline.vue';
  import VitalSignsCard from '@/Components/Patients/VitalSignsCard.vue';

  const route = useRoute();

  const patientId = Number(route.params.id);

  const patient = computed(() => getPatient(patientId));

  const visits = computed(() => getPatientVisits(patientId));

  const prescriptions = computed(() => getPatientPrescriptions(patientId));

  const activeTab = ref<'overview' | 'history' | 'prescription'>('overview');
</script>

<template>
  <div
    v-if="patient"
    class="mx-auto max-w-7xl"
  >
    <Link
      href="/demo/patients"
      class="text-sm font-bold text-[#1B9AAA]"
    >
      ← Kembali ke pasien
    </Link>

    <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-6">
      <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-4">
          <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#06D6A0]/10 text-xl font-black text-[#087F6C]">
            {{ patient.name[0] }}
          </div>

          <div>
            <div class="text-2xl font-black text-[#073B4C]">
              {{ patient.name }}
            </div>

            <div class="mt-1 text-sm text-slate-400">
              {{ patient.medicalRecordNumber }}
            </div>
          </div>
        </div>

        <div class="flex gap-3">
          <button class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600">Edit</button>

          <button class="rounded-xl bg-[#06D6A0] px-4 py-2.5 text-sm font-bold text-[#073B4C]">+ Pemeriksaan</button>
        </div>
      </div>

      <div class="mt-7 grid gap-4 border-t border-slate-100 pt-6 md:grid-cols-4">
        <div>
          <div class="text-xs text-slate-400">Usia</div>

          <div class="mt-1 font-bold">{{ patient.age }} tahun</div>
        </div>

        <div>
          <div class="text-xs text-slate-400">Jenis Kelamin</div>

          <div class="mt-1 font-bold">
            {{ patient.gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
          </div>
        </div>

        <div>
          <div class="text-xs text-slate-400">Golongan Darah</div>

          <div class="mt-1 font-bold">
            {{ patient.bloodType }}
          </div>
        </div>

        <div>
          <div class="text-xs text-slate-400">Telepon</div>

          <div class="mt-1 font-bold">
            {{ patient.phone }}
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
      <div class="flex overflow-x-auto border-b border-slate-100">
        <button
          v-for="tab in [
            ['overview', 'Overview'],
            ['history', 'Riwayat Pemeriksaan'],
            ['prescription', 'Resep'],
          ]"
          :key="tab[0]"
          :class="['whitespace-nowrap px-6 py-4 text-sm font-bold', activeTab === tab[0] ? 'border-b-2 border-[#06D6A0] text-[#087F6C]' : 'text-slate-400']"
          @click="activeTab = tab[0] as typeof activeTab"
        >
          {{ tab[1] }}
        </button>
      </div>

      <div class="p-6">
        <template v-if="activeTab === 'overview'">
          <div>
            <h3 class="font-bold text-[#073B4C]">Pemeriksaan terakhir</h3>

            <div
              v-if="visits[0]"
              class="mt-5"
            >
              <VitalSignsCard :vital-signs="visits[0].vitalSigns" />
            </div>
          </div>

          <div class="mt-8">
            <h3 class="font-bold text-[#073B4C]">Informasi Pasien</h3>

            <div class="mt-4 grid gap-5 md:grid-cols-2">
              <div>
                <div class="text-xs text-slate-400">Tanggal Lahir</div>

                <div class="mt-1 font-medium">
                  {{ patient.birthDate }}
                </div>
              </div>

              <div>
                <div class="text-xs text-slate-400">Alamat</div>

                <div class="mt-1 font-medium">
                  {{ patient.address }}
                </div>
              </div>
            </div>
          </div>
        </template>

        <template v-else-if="activeTab === 'history'">
          <PatientTimeline :visits="visits" />
        </template>

        <template v-else>
          <div class="space-y-4">
            <div
              v-for="prescription in prescriptions"
              :key="prescription.id"
              class="rounded-2xl border border-slate-200 p-5"
            >
              <div class="flex justify-between">
                <div>
                  <div class="text-xs text-slate-400">
                    {{ prescription.date }}
                  </div>

                  <div class="mt-1 font-bold text-[#073B4C]">
                    {{ prescription.doctor }}
                  </div>
                </div>

                <span class="h-fit rounded-lg bg-[#06D6A0]/10 px-3 py-1 text-xs font-bold text-[#087F6C]">
                  {{ prescription.status }}
                </span>
              </div>

              <div class="mt-5 divide-y divide-slate-100">
                <div
                  v-for="item in prescription.items"
                  :key="item.medicine"
                  class="flex items-center justify-between py-3"
                >
                  <div>
                    <div class="font-bold">
                      {{ item.medicine }}
                    </div>

                    <div class="text-xs text-slate-400">{{ item.dosage }} · {{ item.frequency }}</div>
                  </div>

                  <div class="text-sm font-bold">{{ item.quantity }} {{ item.unit }}</div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>

  <div
    v-else
    class="rounded-2xl bg-white p-10 text-center"
  >
    <div class="text-xl font-bold">Pasien tidak ditemukan</div>

    <Link
      href="/demo/patients"
      class="mt-4 inline-block text-[#1B9AAA]"
    >
      Kembali
    </Link>
  </div>
</template>
