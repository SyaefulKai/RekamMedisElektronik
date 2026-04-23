<script setup lang="ts">
import { Button } from '@/components/ui/button';
import PatientField from '@/pages/patient/components/form/PatientField.vue';
import { CreatePatientSchema } from '@/schemas/patient';
import { Patient } from '@/types/resources/patient';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed, toValue } from 'vue';
import { z } from 'zod';

const props = defineProps<{
    medical_record_number?: string;
    patient?: Patient;
    formId: string;
    submitLabel: string;
}>();

const emit = defineEmits<{
    (e: 'submit', val: z.infer<typeof CreatePatientSchema>): void;
}>();

const form = useForm({
    validationSchema: toTypedSchema(CreatePatientSchema),
    initialValues: toValue(computed(() =>
        props.patient
            ? { ...props.patient, birth_date: new Date(props.patient.birth_date) }
            : { medical_record_number: props.medical_record_number }
    )),
});

const submit = form.handleSubmit((data) => emit('submit', data));
</script>

<template>
    <form :id="formId" class="flex flex-col gap-4" @submit="submit">
        <PatientField />
    </form>
    <div>
        <Button :form="formId">{{ submitLabel }}</Button>
    </div>
</template>