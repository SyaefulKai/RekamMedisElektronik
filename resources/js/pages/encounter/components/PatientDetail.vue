<script setup lang="ts">
import { Patient } from '@/types/resources/patient';
defineProps<{
    patient: Patient;
}>();
</script>

<template>
    <div class="flex justify-between gap-4 rounded border">
        <div class="w-full border-r p-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Nomor Rekam Medis</h4>
            <small class="text-sm font-medium leading-none"> {{ patient.medical_record_number }} </small>
        </div>
        <div class="w-full border-r p-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Nama</h4>
            <small class="text-sm font-medium leading-none"> {{ patient.name }} </small>
        </div>
        <div class="w-full border-r p-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Tanggal Lahir</h4>
            <small class="text-sm font-medium leading-none"> {{ patient.birth_date }} </small>
        </div>
        <div class="w-full border-r p-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Pekerjaan</h4>
            <small class="text-sm font-medium leading-none"> {{ patient.occupation }} </small>
        </div>
    </div>
</template>
