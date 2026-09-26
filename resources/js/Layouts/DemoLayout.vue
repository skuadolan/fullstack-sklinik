<script setup lang="ts">
  import DemoSidebar from '@/Components/Demo/DemoSidebar.vue';
  import DemoTopbar from '@/Components/Demo/DemoTopbar.vue';
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <DemoSidebar />

    <div class="lg:pl-64">
      <DemoTopbar />

      <main class="p-4 md:p-6 lg:p-8">
        <RouterView />
      </main>
    </div>
  </div>
</template>
