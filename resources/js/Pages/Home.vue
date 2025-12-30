<script setup>
import { useStore } from "vuex";
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";

import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';

import LoginComponent from "@/Layouts/LoginLayout.vue";
import RegisterComponent from "@/Layouts/RegisterLayout.vue";

import LoadingContainer from "@/Components/Loading/OverlayLoading.vue";

const store = useStore();
const isUserLogin = computed(() => store.state.STORE_SESSION.isUserLogin);

const selectedTab = ref(0);
function changeTab(index) { selectedTab.value = index; }
const classTabOff = "border bg-white text-gray-800 border-gray-200 hover:bg-gray-100";
const classTabActive = "border-t border-b bg-gray-900 text-white  border-gray-900 hover:bg-gray-800";

// JQuery Section START
$(document).ready(function () {
    $("#LoadingContainer").hide();
});
// JQuery Section END
</script>

<template>

    <Head title="Welcome" />

    <template v-if="!isUserLogin">
        <div class="min-h-screen flex items-center justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <TabGroup :selectedIndex="selectedTab" @change="changeTab">
                    <TabList class="flex justify-center">
                        <Tab class="w-full cursor-pointer flex justify-center font-medium rounded-l px-5 py-2" :class="selectedTab == 0 ? classTabActive : classTabOff">
                            Login
                        </Tab>
                        <Tab class="w-full cursor-pointer flex justify-center font-medium px-5 py-2" :class="selectedTab == 1 ? classTabActive : classTabOff">
                            Register
                        </Tab>
                    </TabList>
                    <TabPanels class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 min-h-[fit-content] max-h-[900px] overflow-auto">
                        <TabPanel>
                            <LoginComponent />
                        </TabPanel>
                        <TabPanel>
                            <RegisterComponent />
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </template>
    <template v-else>
        <div>
        </div>
    </template>

    <LoadingContainer id="LoadingContainer" />
</template>
