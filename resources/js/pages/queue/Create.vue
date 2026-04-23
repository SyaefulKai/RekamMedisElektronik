<script setup lang="ts">
import { create, store } from '@/actions/App/Http/Controllers/QueueController';
import AppLayout from '@/layouts/AppLayout.vue';
import QueueForm from '@/pages/queue/components/form/QueueForm.vue';
import { BreadcrumbItem } from '@/types';
import { Patient } from '@/types/resources/patient';
import { Practitioner } from '@/types/resources/practitioner';
import { Head, router } from '@inertiajs/vue3';
import { provide } from 'vue';
import { useDebounceFn } from '@vueuse/core';
import { z } from 'zod';
import { CreateQueueSchema } from '@/schemas/queue';

const props = defineProps<{
    patient: Patient,
    practitioners: Practitioner[]
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Buat Antrian',
        href: '',
    },
];

const searchPractitioner = useDebounceFn((name: string) => {
    router.get(create({
        patient: props.patient.id
    }).url, {
        filter: {
            name: name
        }
    }, {
        preserveState: true,
        preserveScroll: true
    })
}, 500)

const submit = (val: z.infer<typeof CreateQueueSchema>) => {
    router.post(store({
        patient: props.patient.id,
    }).url, val)
}

provide('searchPractitioner', searchPractitioner)
</script>

<template>
    <Head title="Buat Antrian" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">

            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Buat Antrian</h1>
            <QueueForm
            form-id="create-queue"
            :patient="patient"
            :practitioners="practitioners"
            @form:submit="submit"/>
        </div>
    </AppLayout>
</template>
