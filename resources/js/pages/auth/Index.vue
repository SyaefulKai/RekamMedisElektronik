<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import DataTablePagination from '@/components/ui/datatable/DataTablePagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user';
import { BreadcrumbItem, Pagination, User } from '@/types';
import { ref } from 'vue';
import { UserColumn } from './columns/user-column';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pengguna',
        href: index().url,
    },
];

defineProps<{
    users: Pagination<User>;
}>();

const loading = ref(false);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pengguna</h1>
            <DataTable :columns="UserColumn" :pagination="users" @loading="(val) => (loading = val)">
                <template #pagination="{ table }">
                    <DataTablePagination :table="table" :loading="loading" />
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
