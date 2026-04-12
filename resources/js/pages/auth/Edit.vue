<script setup lang="ts">
import { edit, index } from '@/actions/App/Http/Controllers/Auth/UserController';
import AppLayout from '@/layouts/AppLayout.vue';
import EditUserForm from '@/pages/auth/components/EditUserForm.vue';
import { CreateUserSchema } from '@/schemas/user';
import { BreadcrumbItem, Role, User } from '@/types';
import { z } from 'zod';

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

const handleEdit = (data: Omit<z.infer<typeof CreateUserSchema>, 'password'>) => {
    
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
             <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Edit Pengguna</h1>
            <div class="px-4">
                <EditUserForm :roles="roles" :user="user" @submit="handleEdit"/>
            </div>
        </div>
    </AppLayout>
</template>
