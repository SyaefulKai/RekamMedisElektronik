<script setup lang="ts">
import { create, index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import AppLayout from '@/layouts/AppLayout.vue';
import CreatePatientForm from '@/pages/patient/components/CreatePatientForm.vue';
import { store } from '@/routes/patient';
import { CreatePatientSchema } from '@/schemas/patient';
import { BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { z } from 'zod';

const breadcrumbs: BreadcrumbItem[] = [
    {
        'title': 'Pasien',
        'href': index().url
    },
    {
        'title': 'Tambah Pasien',
        'href': create().url
    }
]

defineProps<{
    medical_record_number: string
}>()

const handleSubmit = (data: z.infer<typeof CreatePatientSchema>) => {
    router.post(store().url, data);
}
</script>

<template>
    <Head title="Tambah Pasien"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Tambah Pasien</h1>
            <CreatePatientForm @submit="handleSubmit" :medical_record_number="medical_record_number"/>
        </div>
    </AppLayout>
</template>
