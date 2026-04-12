<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem, Pagination } from '@/types';
import { Patient } from '@/types/resources/patient';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { PatientColumn } from '@/pages/patient/columns/patient-column';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url
    }
]

defineProps<{
    patients: Pagination<Patient>
}>()

const column = PatientColumn()
</script>

<template>
    <Head title="Pasien"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pasien</h1>
            <DataTable :columns="column" :pagination="patients"/>
        </div>
    </AppLayout>
</template>
