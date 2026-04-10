<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Role } from '@/types';
import { Head } from '@inertiajs/vue3';
import RoleCardList from './components/RoleCardList.vue';
import { index } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import CreateRoleButton from './components/CreateRoleButton.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: index().url,
    },
];

defineProps<{
    roles: Role[];
}>();
</script>

<template>
    <Head title="Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <div class="flex flex-col justify-between gap-4 md:flex-row">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Role</h1>
                <CreateRoleButton />
            </div>
            <div class="flex flex-col gap-4 md:grid md:grid-cols-4">
                <RoleCardList :roles="roles" />
            </div>
        </div>
    </AppLayout>
</template>
