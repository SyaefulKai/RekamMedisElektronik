<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user';
import { BreadcrumbItem, Pagination, Role, User } from '@/types';
import { Head } from '@inertiajs/vue3';
import { UserColumn } from './columns/user-column';
import CreateUserButton from './components/CreateUserButton.vue';
import { Practitioner } from '@/types/resources/practitioner';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pengguna',
        href: index().url,
    },
];

defineProps<{
    users: Pagination<User & {
        roles: Role[],
        practitioner?: Practitioner
    }>;
}>();

const column = UserColumn;
</script>

<template>
    <Head title="Pengguna" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pengguna</h1>
                <CreateUserButton />
            </div>
            <DataTable :columns="column" :pagination="users" />
        </div>
    </AppLayout>
</template>
