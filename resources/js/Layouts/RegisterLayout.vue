<script setup>
import wilayahApi from '../Services/GetWilayahApi.js';

import { ref, computed, onMounted, watch } from 'vue';

import { id } from 'date-fns/locale';
import Datepicker from 'vue3-datepicker';
import { useForm } from '@inertiajs/vue3';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputText from '@/Components/Input/InputText.vue';
import BtnPrimary from '@/Components/Btn/BtnPrimary.vue';
import ACWilayah from '@/Components/Input/ACWilayah.vue';
import InputNumber from '@/Components/Input/InputNumber.vue';

const formData = useForm({
    nik: "",
    birthdate: ref(new Date()),
    first_name: "",
    last_name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
    provinsi: "",
    kabupaten: "",
    kecamatan: "",
    kelurahan: "",
});

const fxdBirthdate = computed(() => {
    return `${formData.birthdate.getDate()}-${formData.birthdate.getMonth() + 1}-${formData.birthdate.getFullYear()}`;
});

function submitForm() {
    if ((formData.nik).length == 0) {
        const msgNIK = "NIK tidak boleh kosong!";

        AllNotify("warning", { text: msgNIK });

        return;
    }

    if ((formData.nik).length < 12 && (formData.nik).length < 18) {
        const msgNIK = "NIK tidak boleh kurang dari 12 karakter!";

        AllNotify("warning", { text: msgNIK });

        return;
    }

    SwalModal({
        title: "Konfirmasi",
        html: "Apakah anda yakin data sudah sesuai?",
        icon: "question",
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: "Batal",
    }).then((isConfirmed) => {
        if (!isConfirmed) return;

        formData.post(route('register'), {
            onStart: function () { $("#LoadingContainer").show(); },
            onFinish: function () {
                $("#LoadingContainer").hide();
                formData.reset('password', 'password_confirmation');

                toastrCustomized("success", "Berhasil membuat akun!");
            },
            onError: function (response) {
                console.dir(response);

                $("#LoadingContainer").hide();
            }
        });
    });
};

const listProvinsi = ref([]);
const listKabupaten = ref([]);
const listKecamatan = ref([]);
const listKelurahan = ref([]);

onMounted(async () => { listProvinsi.value = (await wilayahApi.getProvinsi())?.data; });

watch(() => formData.provinsi, async (val) => {
    if (!val) return

    formData.kabupaten = null;
    formData.kecamatan = null;
    formData.kelurahan = null;

    listKabupaten.value = [];
    listKecamatan.value = [];
    listKelurahan.value = [];

    listKabupaten.value = (await wilayahApi.getKabupaten(val.id))?.data;
  }
);

watch(() => formData.kabupaten, async (val) => {
    if (!val) return
  
    formData.kecamatan = null;
    formData.kelurahan = null;

    listKecamatan.value = (await wilayahApi.getKecamatan(val.id))?.data;
  }
);

watch(() => formData.kecamatan, async (val) => {
    if (!val) return

    listKelurahan.value = (await wilayahApi.getKelurahan(val.id))?.data;
  }
);


// JQuery Section START
$(document).ready(function () {
    $("input[type=text].input_nik").on("input", function () {
        const regex = /^.{0,18}$/;
        const inputChar = $(this).val();
        const msgNIK = "NIK tidak boleh lebih dari 18 karakter!";

        if (inputChar.length > 18) {
            $(this).val('');
            AllNotify("warning", { text: msgNIK });

            formData.nik = "";
        } else if (!regex.test(inputChar)) {
            const newValue = inputChar.substring(0, 18);
            $(this).val(newValue);
        }
    });

    $("input[type=text].capitalize").on("input", function () {
        const realValue = $(this).val();
        const newValue = realValue.charAt(0).toUpperCase() + realValue.slice(1);
        $(this).val(newValue);
    });
});
// JQuery Section END
</script>

<template>
    <form @submit.prevent="submitForm" method="POST">
        <div class="mt-6">
            <InputLabel for="nik" class="block text-sm font-medium leading-5  text-gray-700" value="NIK" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <InputNumber v-model="formData.nik" id="nik" name="nik" type="text" class="input_nik" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.nik" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="birthdate" class="block text-sm font-medium leading-5  text-gray-700" value="Tanggal Lahir" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <Datepicker v-model="formData.birthdate" :value="fxdBirthdate" :locale="id" id="birthdate" name="birthdate" inputFormat="dd-MM-yyyy"
                        class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600   dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.birthdate" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="first_name" class="block text-sm font-medium leading-5  text-gray-700" value="Nama Depan" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <InputText v-model="formData.first_name" id="first_name" name="first_name" type="text" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.first_name" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="last_name" class="block text-sm font-medium leading-5  text-gray-700" value="Nama Belakang" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <InputText v-model="formData.last_name" id="last_name" name="last_name" type="text" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.last_name" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="provinsi" class="block text-sm font-medium leading-5  text-gray-700" value="Provinsi" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <ACWilayah v-model="formData.provinsi" :items="listProvinsi" placeholder="Pilih Provinsi" id="provinsi" name="provinsi" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.provinsi" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="kabupaten" class="block text-sm font-medium leading-5  text-gray-700" value="Kabupaten" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <ACWilayah v-model="formData.kabupaten" :items="listKabupaten" placeholder="Pilih Kabupaten" id="kabupaten" name="kabupaten" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.kabupaten" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="kecamatan" class="block text-sm font-medium leading-5  text-gray-700" value="Kecamatan" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <ACWilayah v-model="formData.kecamatan" :items="listKecamatan" placeholder="Pilih Kecamatan" id="kecamatan" name="kecamatan" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.kecamatan" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="kelurahan" class="block text-sm font-medium leading-5  text-gray-700" value="Kelurahan" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <ACWilayah v-model="formData.kelurahan" :items="listKelurahan" placeholder="Pilih Kelurahan" id="kelurahan" name="kelurahan" class="capitalize" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.kelurahan" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="username" class="block text-sm font-medium leading-5  text-gray-700" value="Username" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <InputText v-model="formData.username" id="username" name="username" type="username" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.username" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="email" class="block text-sm font-medium leading-5  text-gray-700" value="Email" />
            <div class="mt-1 rounded-md shadow-sm">
                <div class="w-full">
                    <InputText v-model="formData.email" id="email" name="email" type="email" />
                </div>
                <InputError class="mt-2 italic" :message="formData.errors.email" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="password" class="block text-sm font-medium leading-5  text-gray-700" value="Password" />
            <div class="mt-1 rounded-md shadow-sm">
                <InputText v-model="formData.password" id="password" name="password" type="password" />
                <InputError class="mt-2 italic" :message="formData.errors.password" />
            </div>
        </div>

        <div class="mt-6">
            <InputLabel for="password_confirmation" class="block text-sm font-medium leading-5  text-gray-700" value="Confirm Password" />
            <div class="mt-1 rounded-md shadow-sm">
                <InputText v-model="formData.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" />
                <InputError class="mt-2 italic" :message="formData.errors.password_confirmation" />
            </div>
        </div>

        <p class="mt-2 cursor-pointer text-blue-500 hover:text-blue-600 w-fit">Have an account?</p>

        <div class="flex flex-col gap-2">
            <BtnPrimary @click="submit">Create account</BtnPrimary>
        </div>
    </form>
</template>
