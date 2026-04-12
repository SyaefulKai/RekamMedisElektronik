<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { BreadcrumbItem, Pagination } from '@/types';
import { Patient } from '@/types/resources/patient';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { PatientColumn } from '@/pages/patient/columns/patient-column';
import DataTableSearch from '@/components/ui/datatable/DataTableSearch.vue';
import { useDebounceFn } from '@vueuse/core';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url
    }
]

const props = defineProps<{
    patients: Pagination<Patient>
}>()

const patients = computed(() => props.patients)

const column = PatientColumn()

const handleSearch = useDebounceFn((value: string) => {
    router.get(index().url, {
        filter: {
            name: value
        }
    }, {
        preserveState: true,
        replace: true
    })
}, 500)
</script>

<template>
    <Head title="Pasien"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pasien</h1>
            <DataTable :columns="column" :pagination="patients">
                <template #toolbar>
                    <DataTableSearch @input="handleSearch"/>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
