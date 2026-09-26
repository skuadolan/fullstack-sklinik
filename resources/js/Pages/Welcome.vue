<script setup lang="ts">
  import LandingNavbar from '@/Components/Landing/Navbar.vue';
  import HeroSection from '@/Components/Landing/HeroSection.vue';
  import FeatureSection from '@/Components/Landing/FeatureSection.vue';
  import WorkflowSection from '@/Components/Landing/WorkflowSection.vue';
  import DemoPreview from '@/Components/Demo/DemoPreview.vue';
  import PricingSection from '@/Components/Landing/PricingSection.vue';
  import CTASection from '@/Components/Landing/CTASection.vue';
</script>

<template>
  <div class="min-h-screen bg-[#F8FFE5] text-slate-800">
    <LandingNavbar />

    <main>
      <HeroSection />

      <FeatureSection />

      <WorkflowSection />

      <DemoPreview />

      <PricingSection />

      <CTASection />
    </main>

    <footer class="border-t border-slate-200 bg-white">
      <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-8 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
        <div>© {{ new Date().getFullYear() }} Rekamin Pasien.</div>

        <div class="flex gap-6">
          <a
            href="#"
            class="hover:text-[#1B9AAA]"
          >
            Tentang
          </a>

          <a
            href="#"
            class="hover:text-[#1B9AAA]"
          >
            Privasi
          </a>

          <a
            href="#"
            class="hover:text-[#1B9AAA]"
          >
            Bantuan
          </a>
        </div>
      </div>
    </footer>
  </div>
</template>
