<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/QueueController';
import DataTable from '@/components/ui/datatable/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { QueueColumn } from '@/pages/queue/columns/queue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { onUnmounted } from 'vue';
import { toast } from 'vue-sonner';

defineProps<{
    queues: any
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Antrian',
        href: index().url
    }
]

const flashEvent = router.on('flash', (flashProps) => {
    if(flashProps.detail.flash) toast.success(flashProps.detail.flash.queueCreated as string)
})

onUnmounted(() => flashEvent())
</script>

<template>
<Head title="Antrian"/>
<AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-8 flex flex-col gap-4">
        <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Antrian Hari Ini</h1>
        <DataTable :columns="QueueColumn" :pagination="queues"/>
    </div>
</AppLayout>
</template>
