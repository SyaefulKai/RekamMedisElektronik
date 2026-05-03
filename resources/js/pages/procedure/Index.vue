<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/ProcedureController';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ProcedureColumn } from '@/pages/procedure/columns/procedure-column';
import { BreadcrumbItem, Pagination } from '@/types';
import { Icd9, Procedure } from '@/types/resources/procedure';
import { Head } from '@inertiajs/vue3';

defineProps<{
    codes: Icd9[];
    procedures: Pagination<Procedure>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tindakan',
        href: index().url,
    },
];
</script>

<template>
    <Head title="Tindakan" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8">
            <div>
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Tindakan</h1>
            </div>
            <DataTable :columns="ProcedureColumn" :pagination="procedures" />
        </div>
    </AppLayout>
</template>
