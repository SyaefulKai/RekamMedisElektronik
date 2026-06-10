<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import DataTableSearch from '@/components/ui/datatable/DataTableSearch.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user';
import { BreadcrumbItem, Pagination, Role, User } from '@/types';
import { Practitioner } from '@/types/resources/practitioner';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { UserColumn } from './columns/user-column';
import LinkButton from '@/components/LinkButton.vue';
import { create } from '@/actions/App/Http/Controllers/Auth/UserController';
import { onUnmounted } from 'vue';
import { toast } from 'vue-sonner';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pengguna',
        href: index().url,
    },
];

defineProps<{
    users: Pagination<
        User & {
            roles: Role[];
            practitioner?: Practitioner;
        }
    >;
}>();

const handleSearch = useDebounceFn((value) => {
    router.get(
        index().url,
        {
            filter: {
                name: value,
            },
        },
        {
            preserveState: true,
            replace: true,
        },
    );
}, 500);

const column = UserColumn;

const flashEvent = router.on('flash', (flashProps) => {
    const flashMessage = flashProps.detail.flash
    if(flashMessage.practitionerCreated) toast.success(flashMessage.practitionerCreated as string)
    if(flashMessage.userCreated) toast.success(flashMessage.userCreated as string)
    if(flashMessage.userUpdated) toast.success(flashMessage.userUpdated as string)
    if(flashMessage.userDeleted) toast.success(flashMessage.userDeleted as string)
})

onUnmounted(() => flashEvent())
</script>

<template>
    <Head title="Pengguna" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Daftar Pengguna</h1>
            </div>
            <DataTable :columns="column" :pagination="users">
                <template #toolbar>
                    <div class="flex w-full flex-col gap-4 md:w-[50%] md:flex-row lg:w-[25%]">
                        <LinkButton :href="create().url" label="Tambah Pengguna" />
                        <DataTableSearch @input="handleSearch" class="grow" />
                    </div>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>
