<script setup lang="ts">
import { history, index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { PatientHistoryColumn } from '@/pages/patient/columns/patient-history-column';
import { BreadcrumbItem, Pagination } from '@/types';
import { Encounter } from '@/types/resources/encounter';
import { Patient } from '@/types/resources/patient';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    patient: Patient;
    encounters: Pagination<Encounter>;
}>();

const patient = computed(() => props.patient);
const encounters = computed(() => props.encounters);

const columns = PatientHistoryColumn();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url,
    },
    {
        title: `Riwayat - ${patient.value.name}`,
        href: history({
            patient: patient.value.id,
        }).url,
    },
];
</script>

<template>
    <Head :title="`Riwayat Rekam Medis - ${patient.name}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">
                Riwayat Rekam Medis
            </h1>

            <div class="flex flex-col gap-2 rounded-md border p-4 md:flex-row md:items-center md:gap-8">
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">No. Rekam Medis</span>
                    <span class="font-medium">{{ patient.medical_record_number }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Nama Pasien</span>
                    <span class="font-medium">{{ patient.name }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Tanggal Lahir</span>
                    <span class="font-medium">{{ patient.birth_date }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Jenis Kelamin</span>
                    <span class="font-medium">{{ patient.gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}</span>
                </div>
            </div>

            <DataTable :columns="columns" :pagination="encounters" />
        </div>
    </AppLayout>
</template>
