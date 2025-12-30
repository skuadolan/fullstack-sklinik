<script setup>
import InputText from '@/Components/Input/InputText.vue';
import BtnPrimary from '@/Components/Btn/BtnPrimary.vue';
</script>

<template>
    <form class="flex flex-col gap-4 pb-4">
        <div>
            <div class="mb-2">
                <label class="text-sm font-medium text-gray-900" for="username">Username:</label>
            </div>
            <div class="flex w-full rounded-lg pt-1">
                <div class="relative w-full">
                    <InputText id="username" type="username" name="username" required />
                </div>
            </div>
        </div>
        <div>
            <div class="mb-2">
                <label class="text-sm font-medium text-gray-900" data-testid="flowbite-label" for="password">Password</label>
            </div>
            <div class="flex w-full rounded-lg pt-1">
                <div class="relative w-full">
                    <InputText id="password" type="password" name="password" required />
                </div>
            </div>
        </div>
    </form>

    <p class="mt-2 cursor-pointer text-blue-500 hover:text-blue-600 w-fit">Forgot password?</p>

    <div class="flex flex-col gap-2">
        <BtnPrimary>Login</BtnPrimary>
    </div>
</template>
