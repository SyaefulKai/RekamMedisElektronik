<script setup lang="ts">
import { create, index, store } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import CreateRoleForm from './components/CreateRoleForm.vue';
import { router } from '@inertiajs/vue3';
import { CreateRoleRequest } from '@/types/authorization/role';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Peran',
        href: index().url,
    },
    {
        title: 'Tambah Peran',
        href: create().url,
    },
];

const storeRecord = (data: CreateRoleRequest) => {
    router.post(store().url, data);
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <CreateRoleForm @submitted="storeRecord"/>
        </div>
    </AppLayout>
</template>
