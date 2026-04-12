<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Role } from '@/types';
import { usePage } from '@inertiajs/vue3';
import PermissionList from './components/PermissionList.vue';
import { ref } from 'vue';
import SavePermissionButton from './components/SavePermissionButton.vue';
import { index } from '@/actions/App/Http/Controllers/Authorization/RoleController';

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Peran',
        href: index().url,
    },
    {
        title: 'Edit Peran',
        href: page.url,
    },
];

const permissions = ref<string[]>([]);

defineProps<{
    role: Role;
}>();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="p-4 flex justify-between">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">{{ role.name }}</h1>
                <SavePermissionButton
                :permissions="permissions"
                :role="role"/>
            </div>
            <div class="flex flex-col md:grid md:grid-cols-3 gap-4">
                <PermissionList
                :permissions="role.permissions"
                @checked="(val) => permissions = val"/>
            </div>
        </div>
    </AppLayout>
</template>
