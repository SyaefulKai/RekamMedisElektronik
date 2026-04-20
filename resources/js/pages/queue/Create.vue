<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import CreateQueueForm from '@/pages/queue/components/CreateQueueForm.vue';
import { BreadcrumbItem } from '@/types';
import { Patient } from '@/types/resources/patient';
import { Practitioner } from '@/types/resources/practitioner';
import { Head } from '@inertiajs/vue3';

defineProps<{
    patient: Patient,
    practitioners: Practitioner[]
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Buat Antrian',
        href: '',
    },
];
</script>

<template>
    <Head title="Buat Antrian" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Buat Antrian</h1>
            <CreateQueueForm :patient="patient" :practitioners="practitioners"/>
        </div>
    </AppLayout>
    <Button form="edit-patient">Buat Antrian</Button>
</template>
