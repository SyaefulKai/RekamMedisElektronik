<script setup lang="ts">
import { useProcedureCode } from '@/composables/useProcedureCode';
import AppLayout from '@/layouts/AppLayout.vue';
import ProcedureForm from '@/pages/procedure/components/ProcedureForm.vue';
import { create, index, store } from '@/routes/procedure/index';
import { CreateProcedureInput } from '@/schemas/procedure';
import { BreadcrumbItem } from '@/types';
import { Icd9 } from '@/types/resources/procedure';
import { router } from '@inertiajs/vue3';
import { provide, toRef } from 'vue';

const props = defineProps<{
    codes: Icd9[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tindakan',
        href: index().url,
    },
    {
        title: 'Tambah Tindakan',
        href: create().url,
    },
];

const procedureCode = useProcedureCode();
const searchProcedureCode = (query: Record<string, any>) => {
    procedureCode.search(create(), query);
};

const storeProcedure = (val: CreateProcedureInput) => {
    router.post(store().url, val);
};

provide('codes', toRef(props, 'codes'));
provide('searchCode', searchProcedureCode);
provide('storeProcedure', storeProcedure);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Tambah Tindakan</h1>
            <ProcedureForm />
        </div>
    </AppLayout>
</template>
