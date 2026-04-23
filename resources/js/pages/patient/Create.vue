<script setup lang="ts">
import { create, index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import AppLayout from '@/layouts/AppLayout.vue';
import PatientForm from '@/pages/patient/components/form/PatientForm.vue';
import { store } from '@/routes/patient';
import { CreatePatientSchema } from '@/schemas/patient';
import { BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { z } from 'zod';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url,
    },
    {
        title: 'Tambah Pasien',
        href: create().url,
    },
];

defineProps<{
    medical_record_number: string;
}>();

const handleSubmit = (data: z.infer<typeof CreatePatientSchema>) => {
    router.post(store().url, data);
};
</script>

<template>
    <Head title="Tambah Pasien" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Tambah Pasien</h1>
            <PatientForm
                @submit="handleSubmit"
                form-id="create-patient"
                submit-label="Tambah Pasien"
                :medical_record_number="medical_record_number"
            />
        </div>
    </AppLayout>
</template>
