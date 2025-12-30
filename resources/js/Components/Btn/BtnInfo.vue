<script setup></script>

<template>
    <button class="btn cursor-pointer disabled:cursor-not-allowed bg-[hsl(197,100%,60%)] focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 hover:bg-[hsl(197,100%,75%)] active:bg-blue-900 text-white disabled:bg-blue-700 disabled:text-white rounded-lg">
        <span class="flex items-center justify-center gap-1 font-medium py-1 px-2.5 text-base false">
            <slot />
        </span>
    </button>
</template>