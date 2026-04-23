<script setup lang="ts">
import { edit, index } from '@/actions/App/Http/Controllers/Resources/PatientController';
import AppLayout from '@/layouts/AppLayout.vue';
import PatientForm from '@/pages/patient/components/form/PatientForm.vue';
import { CreatePatientSchema } from '@/schemas/patient';
import { BreadcrumbItem } from '@/types';
import { Patient } from '@/types/resources/patient';
import { Head, router } from '@inertiajs/vue3';
import { z } from 'zod';

const props = defineProps<{
    patient: Patient;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pasien',
        href: index().url,
    },
    {
        title: 'Edit Pasien',
        href: edit({
            patient: props.patient.id,
        }).url,
    },
];

const handleEdit = (val: z.infer<typeof CreatePatientSchema>) => {
    router.patch(
        edit({
            patient: props.patient.id,
        }).url,
        val,
    );
};
</script>

<template>
    <Head title="Edit Pasien" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-8">
            <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">Edit Pasien</h1>
            <PatientForm @submit="handleEdit" form-id="edit-patient" submit-label="Edit Pasien" :patient="patient" />
        </div>
    </AppLayout>
</template>
