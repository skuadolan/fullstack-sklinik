<script setup></script>

<template>
    <button class="border transition-colors focus:ring-2 p-0.5 cursor-pointer disabled:cursor-not-allowed border-transparent bg-gray-800 hover:bg-gray-900 active:bg-gray-700 text-white disabled:bg-gray-300 disabled:text-gray-700 rounded-lg">
        <span class="flex items-center justify-center gap-1 font-medium py-1 px-2.5 text-base false">
            <slot />
        </span>
    </button>
</template>