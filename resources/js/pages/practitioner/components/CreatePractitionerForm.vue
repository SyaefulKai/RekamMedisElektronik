<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod';
import { CreatePractitionerSchema,  practitionerTypes} from '@/schemas/practitioner';
import { useForm, Field as VeeField } from 'vee-validate';
import { Field, FieldError, FieldLabel } from '@/components/ui/field';
import FieldContent from '@/components/ui/field/FieldContent.vue';
import { Input } from '@/components/ui/input';
import { NativeSelect, NativeSelectOption } from '@/components/ui/native-select';
import { z } from 'zod';
import { Button } from '@/components/ui/button';

const schema = toTypedSchema(CreatePractitionerSchema)

const form = useForm({
    validationSchema: schema,
})

const emit = defineEmits<{
    (e: 'submit', val: z.infer<typeof CreatePractitionerSchema>): void
}>()

const submit = form.handleSubmit(val => emit('submit', val))

</script>

<template>
    <form id="create-practitioner" class="flex flex-col lg:grid lg:grid-cols-2 gap-4 p-8" @submit="submit">
        <VeeField name="nik" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>NIK Praktisi</FieldLabel>
                <FieldContent>
                    <Input v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map((error) => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
        <VeeField name="type" v-slot="{errors}">
            <Field>
                <FieldLabel>Tipe Praktisi</FieldLabel>
                <FieldContent>
                    <NativeSelect @change="(e: Event) => form.setFieldValue('type', (e.target as HTMLSelectElement).value as any)">
                        <NativeSelectOption v-for="type in practitionerTypes" :key="type.value" :value="type.value">
                            {{ type.label }}
                        </NativeSelectOption>
                    </NativeSelect>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(err => ({
                    message: err
                }))"/>
            </Field>
        </VeeField>
    </form>
    <div class="flex justify-end items-center px-8">
        <Button form="create-practitioner">Daftarkan</Button>
    </div>
</template>
