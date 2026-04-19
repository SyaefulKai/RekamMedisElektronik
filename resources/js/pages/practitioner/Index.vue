<script setup lang="ts">
import { index, } from '@/actions/App/Http/Controllers/Resources/PractitionerController';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import DataTableSearch from '@/components/ui/datatable/DataTableSearch.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { PractitionerColumn } from '@/pages/practitioner/column/practitioner-column';
import { BreadcrumbItem, Pagination } from '@/types';
import { Practitioner } from '@/types/resources/practitioner';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Praktisi',
        href: index().url,
    },
];

const props = defineProps<{
    practitioners: Pagination<Practitioner>;
}>();

const practitioners = computed(() => props.practitioners);

const column = PractitionerColumn();

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
</script>

<template>
    <Head title="Praktisi" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Praktisi</h1>
            <DataTable :columns="column" :pagination="practitioners">
                <template #toolbar>
                    <div class="flex w-full flex-col gap-4 md:w-[50%] md:flex-row lg:w-[25%]">
                        <DataTableSearch @input="handleSearch" class="grow" />
                    </div>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
