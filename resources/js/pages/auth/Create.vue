<script setup lang="ts">
import { create, index, store } from '@/actions/App/Http/Controllers/Auth/UserController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Role } from '@/types';
import CreateUserForm from './components/CreateUserForm.vue';
import { z } from 'zod';
import { CreateUserSchema } from '@/schemas/user';
import { Head, router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pengguna',
        href: index().url
    },
    {
        title: 'Tambah Pengguna',
        href: create().url
    }
]

defineProps<{
    roles: Role[]
}>()

const handleSubmit = (data: z.infer<typeof CreateUserSchema>) => {
    router.post(store().url, data);
}
</script>

<template>
    <Head title="Tambah Pengguna"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8">
            <CreateUserForm :roles="roles" @submit="handleSubmit"/>
        </div>
    </AppLayout>
</template>
