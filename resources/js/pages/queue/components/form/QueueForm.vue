<script setup lang="ts">
import { Button } from '@/components/ui/button';
import PatientField from '@/pages/patient/components/form/PatientField.vue';
import QueueOptionField from '@/pages/queue/components/form/QueueOptionField.vue';
import { CreateQueueSchema } from '@/types/queue';
import { Patient } from '@/types/resources/patient';
import { Practitioner } from '@/types/resources/practitioner';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed } from 'vue';
import { z } from 'zod';

const props = defineProps<{
    patient: Patient;
    practitioners: Practitioner[];
    formId?: string;
}>();

const emit = defineEmits<{
    (e: 'form:submit', val: z.infer<typeof CreateQueueSchema>): void
}>()

const schema = toTypedSchema(CreateQueueSchema);

const form = useForm({
    validationSchema: schema,
    initialValues: {
        patient: {
            name: props.patient.name,
            nik: props.patient.nik,
            address: props.patient.address,
            occupation: props.patient.occupation,
            birth_date: new Date(props.patient.birth_date),
            medical_record_number: props.patient.medical_record_number,
            gender: props.patient.gender,
        },
    },
});

const practitioners = computed(() => {
    return props.practitioners.map((practitioner) => ({
        value: String(practitioner.user.id),
        label: practitioner.user.name,
    }));
});

const submit = form.handleSubmit((value: z.infer<typeof CreateQueueSchema>) => {
    emit('form:submit', value)
})
</script>

<template>
    <form :id="formId ?? 'queue'" class="flex flex-col gap-4" @submit="submit">
        <PatientField prefix="patient" />
        <QueueOptionField
        :practitioners="practitioners"/>
    </form>
    <div>
        <Button :form="formId ?? 'queue'">Buat Antrian</Button>
    </div>
</template>
