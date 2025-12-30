<script setup></script>

<template>
    <button class="border transition-colors focus:ring-2 p-0.5 cursor-pointer disabled:cursor-not-allowed border-transparent bg-[#ddd] hover:bg-[#ccc] active:bg-[#bbb] text-gray-800 disabled:bg-[#ddd] disabled:text-gray-600 rounded-lg">
        <span class="flex items-center justify-center gap-1 font-medium py-1 px-2.5 text-base false">
            <slot />
        </span>
    </button>
</template>