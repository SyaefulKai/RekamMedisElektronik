<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import DataTablePagination from '@/components/ui/datatable/DataTablePagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user';
import { BreadcrumbItem, Pagination, User } from '@/types';
import { ref } from 'vue';
import { UserColumn } from './columns/user-column';
import CreateUserButton from './components/CreateUserButton.vue';
import { Head } from '@inertiajs/vue3';

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
    <Head title="Pengguna" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col p-8 gap-4">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pengguna</h1>
                <CreateUserButton />
            </div>
            <DataTable :columns="UserColumn" :pagination="users" @loading="(val) => (loading = val)">
                <template #pagination="{ table }">
                    <DataTablePagination :table="table" :loading="loading" />
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
