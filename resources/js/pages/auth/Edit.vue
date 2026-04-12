<script setup lang="ts">
import { edit, index, update } from '@/actions/App/Http/Controllers/Auth/UserController';
import AppLayout from '@/layouts/AppLayout.vue';
import EditUserForm from '@/pages/auth/components/EditUserForm.vue';
import { EditUserSchema } from '@/schemas/user';
import { BreadcrumbItem, Role, User } from '@/types';
import { z } from 'zod';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps<{
    user: User & {
        roles: Role[]
    },
    roles: Role[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pengguna',
        href: index().url
    },
    {
        title: 'Edit Pengguna',
        href: edit({
            user: props.user.id
        }).url
    }
]

const handleEdit = (data: z.infer<typeof EditUserSchema>) => {
    router.patch(update({
        user: props.user.id,
    }), data)
}
</script>

<template>
    <Head title="Edit Pengguna"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
             <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Edit Pengguna</h1>
            <div class="px-4">
                <EditUserForm :roles="roles" :user="user" @submit="handleEdit"/>
            </div>
        </div>
    </AppLayout>
</template>
