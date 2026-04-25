<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/Resources/SubjectiveController';
import { Button } from '@/components/ui/button';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Textarea } from '@/components/ui/textarea';
import AllergyField from '@/pages/encounter/components/AllergyField.vue';
import { SubjectiveSchema, SubjectiveSchemaType } from '@/schemas/encounter';
import { Encounter } from '@/types/resources/encounter';
import { router, usePage } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm, Field as VeeField } from 'vee-validate';
import { inject, Ref, watch } from 'vue';
import { toast } from 'vue-sonner';

const page = usePage();

const schema = toTypedSchema(SubjectiveSchema);

const encounter = inject<Ref<Encounter>>('encounter');

const form = useForm({
    validationSchema: schema,
    initialValues: {
        chief_complaint: encounter?.value?.subjective?.chief_complaint,
        history_of_present_illness: encounter?.value?.subjective?.history_of_present_illness,
        past_medical_history: encounter?.value?.subjective?.past_medical_history,
        family_medical_history: encounter?.value?.subjective?.family_medical_history,
        allergies: encounter?.value?.subjective?.allergies,
    },
});

const submit = form.handleSubmit((val: SubjectiveSchemaType) => {
    if (!encounter) return;
    router.post(
        store({
            encounter: encounter.value?.uuid,
        }).url,
        val,
        {
            onError: (errors) => form.setErrors(errors),
            onSuccess: () => {
                if (page.flash) toast.success(page.flash.subjectiveCreated as string);
            },
            only: ['encounter'],
        },
    );
});

watch(
    () => encounter?.value?.subjective,
    (subjective) => {
        form.resetForm({
            values: {
                chief_complaint: subjective?.chief_complaint,
                history_of_present_illness: subjective?.history_of_present_illness,
                past_medical_history: subjective?.past_medical_history,
                family_medical_history: subjective?.family_medical_history,
                allergies: subjective?.allergies,
            },
        });
    },
);
</script>

<template>
    <form id="subjective" class="flex flex-col gap-4 p-4" @submit="submit">
        <VeeField name="chief_complaint" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Keluhan Utama</FieldLabel>
                <FieldContent>
                    <Textarea
                        :model-value="field.value"
                        @update:modelValue="field.onChange"
                        class="border border-border"
                        placeholder="Tuliskan tentang keluhan yang dialami pasien."
                    />
                </FieldContent>
                <FieldError
                    v-if="errors.length"
                    :errors="
                        errors.map((err) => ({
                            message: err,
                        }))
                    "
                />
            </Field>
        </VeeField>
        <VeeField name="history_of_present_illness" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Detail Keluhan</FieldLabel>
                <FieldContent>
                    <Textarea
                        :model-value="field.value"
                        @update:model-value="field.onChange"
                        class="border border-border"
                        placeholder="Tuliskan riwayat keluhan, sejak kapan, lokasi, durasi, faktor pencetus/peringan, dan gejala penyerta."
                    />
                </FieldContent>
                <FieldError
                    v-if="errors.length"
                    :errors="
                        errors.map((err) => ({
                            message: err,
                        }))
                    "
                />
            </Field>
        </VeeField>
        <VeeField name="past_medical_history" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Riwayat Medis</FieldLabel>
                <FieldContent>
                    <Textarea
                        :model-value="field.value"
                        @update:model-value="field.onChange"
                        class="border border-border"
                        placeholder="Tuliskan riwayat medis yang pernah dialami oleh pasien."
                    />
                </FieldContent>
                <FieldError
                    v-if="errors.length"
                    :errors="
                        errors.map((err) => ({
                            message: err,
                        }))
                    "
                />
            </Field>
        </VeeField>
        <VeeField name="family_medical_history" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Riwayat Medis Keluarga</FieldLabel>
                <FieldContent>
                    <Textarea
                        :model-value="field.value"
                        @update:model-value="field.onChange"
                        class="border border-border"
                        placeholder="Tuliskan riwayat penyakit yang pernah dialami oleh keluarga pasien."
                    />
                </FieldContent>
                <FieldError
                    v-if="errors.length"
                    :errors="
                        errors.map((err) => ({
                            message: err,
                        }))
                    "
                />
            </Field>
        </VeeField>
        <AllergyField />
    </form>
    <div class="flex justify-end px-4">
        <Button form="subjective" type="submit">Simpan</Button>
    </div>
</template>
