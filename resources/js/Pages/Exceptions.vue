<script setup>
  import { Link } from '@inertiajs/vue3';

  const props = defineProps({
    code: Number,
    status: String,
    message: Object || Array || String,
  });
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-[60vh] p-6 text-center">
    <!-- Ikon atau Ilustrasi Error (Opsional) -->
    <div class="text-8xl font-bold text-gray-300 mb-4">
      {{ code }}
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-2">
      {{ status }}
    </h1>

    <p class="text-gray-600 mb-8 max-w-md">
      {{ message }}
    </p>

    <!-- Tombol Kembali ke Home -->
    <Link
      href="/"
      class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition"
    >
      Kembali ke Beranda
    </Link>
  </div>
</template>
