<script setup></script>

<template>
    <button class="border transition-colors focus:ring-2 p-0.5 cursor-pointer disabled:cursor-not-allowed border-transparent bg-[#ffa500] hover:bg-[#ffc080] active:bg-[#ff9900] text-white disabled:bg-[#ffb380] disabled:text-gray-700 rounded-lg">
        <span class="flex items-center justify-center gap-1 font-medium py-1 px-2.5 text-base false">
            <slot />
        </span>
    </button>
</template>