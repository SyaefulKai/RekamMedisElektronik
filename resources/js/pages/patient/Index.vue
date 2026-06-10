<script setup lang="ts">
import { create, index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import LinkButton from '@/components/LinkButton.vue';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import DataTableSearch from '@/components/ui/datatable/DataTableSearch.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { PatientColumn } from '@/pages/patient/columns/patient-column';
import { BreadcrumbItem, Pagination } from '@/types';
import { Patient } from '@/types/resources/patient';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { computed, onUnmounted } from 'vue';
import { toast } from 'vue-sonner';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url,
    },
];

const props = defineProps<{
    patients: Pagination<Patient>;
}>();

const patients = computed(() => props.patients);

const column = PatientColumn();

const handleSearch = useDebounceFn((value: string) => {
    router.get(
        index().url,
        {
            filter: {
                name: value,
            },
        },
        {
            preserveState: true,
            replace: true,
        },
    );
}, 500);

const flashEvent = router.on('flash', (flashProps) => {
    const flashMessage = flashProps.detail.flash
    if(flashMessage.patientCreated) toast.success(flashMessage.patientCreated as string)
    if(flashMessage.patientUpdated) toast.success(flashMessage.patientUpdated as string)
})

onUnmounted(() => flashEvent())
</script>

<template>
    <Head title="Pasien" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pasien</h1>
            <DataTable :columns="column" :pagination="patients">
                <template #toolbar>
                    <div class="flex w-full flex-col gap-4 md:w-[50%] md:flex-row lg:w-[25%]">
                        <LinkButton :href="create().url" label="Tambah Pasien"/>
                        <DataTableSearch @input="handleSearch" class="grow" />
                    </div>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
