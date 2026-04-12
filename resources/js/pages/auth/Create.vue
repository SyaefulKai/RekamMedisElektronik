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
        <div class="p-8 flex flex-col gap-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Tambah Pengguna</h1>
            <div class="px-4">
                <CreateUserForm :roles="roles" @submit="handleSubmit"/>
            </div>
        </div>
    </AppLayout>
</template>
