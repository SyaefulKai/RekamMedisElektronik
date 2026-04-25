<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Role, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import RoleCardList from './components/RoleCardList.vue';
import { index } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import CreateRoleButton from './components/CreateRoleButton.vue';
import { router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { onUnmounted } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Peran',
        href: index().url,
    },
];

const page = usePage<SharedData>()

defineProps<{
    roles: Role[];
}>();

const flashEvent = router.on('flash', (flashProps) => {
    const flashMessage = flashProps.detail.flash
    if(flashMessage.roleCreated) toast.success(flashMessage.roleCreated as string)
    if(flashMessage.roleDeleted) toast.success(flashMessage.roleDeleted as string)
})

onUnmounted(() => flashEvent())
</script>

<template>
    <Head title="Peran" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <div class="flex flex-col justify-between gap-4 md:flex-row">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Peran</h1>
                <CreateRoleButton v-if="page.props.auth.permissions.includes('create.role')"/>
            </div>
            <div class="flex flex-col gap-4 md:grid md:grid-cols-4">
                <RoleCardList :roles="roles" />
            </div>
        </div>
    </AppLayout>
</template>
