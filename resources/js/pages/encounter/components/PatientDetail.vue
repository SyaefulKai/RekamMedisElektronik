<script setup lang="ts">
import { Patient } from '@/types/resources/patient';
defineProps<{
    patient: Patient;
}>();
</script>

<template>
    <div class="flex flex-col md:flex-row rounded border divide-y md:divide-y-0 md:divide-x">
        <div class="w-full p-4">
            <h4 class="text-base md:text-lg font-semibold">Nomor Rekam Medis</h4>
            <small class="text-sm">{{ patient.medical_record_number }}</small>
        </div>

        <div class="w-full p-4">
            <h4 class="text-base md:text-lg font-semibold">Nama</h4>
            <small class="text-sm">{{ patient.name }}</small>
        </div>

        <div class="w-full p-4">
            <h4 class="text-base md:text-lg font-semibold">Tanggal Lahir</h4>
            <small class="text-sm">{{ patient.birth_date }}</small>
        </div>

        <div class="w-full p-4">
            <h4 class="text-base md:text-lg font-semibold">Pekerjaan</h4>
            <small class="text-sm">{{ patient.occupation }}</small>
        </div>
    </div>
</template>
