<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Field, FieldError, FieldLabel } from '@/components/ui/field';
import FieldContent from '@/components/ui/field/FieldContent.vue';
import { Input } from '@/components/ui/input';
import Icd9Combobox from '@/pages/procedure/components/Icd9Combobox.vue';
import { CreateProcedureInput, CreateProcedureSchema } from '@/schemas/procedure';
import { Icd9 } from '@/types/resources/procedure';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm, Field as VeeField } from 'vee-validate';
import { computed, inject, Ref } from 'vue';

const schema = toTypedSchema(CreateProcedureSchema);

const form = useForm({
    validationSchema: schema,
});

const codes = inject<Ref<Icd9[]>>('codes');
const codeItems = computed(() => {
    return codes!.value.map((code) => ({
    label: `${code.code} - ${code.display}`,
    value: code.code,
}))
});

const handleCodeSelection = (value: string) => {
    const selectedCode = codes?.value.find((code) => code.code == value);
    if (!selectedCode) return;
    form.setFieldValue('code', selectedCode.code);
    form.setFieldValue('system', selectedCode.system);
    form.setFieldValue('display', selectedCode.display);
};

const storeMethod = inject<(val: CreateProcedureInput) => void>('storeProcedure', () => {})
const submit = form.handleSubmit(storeMethod)
</script>

<template>
    <form id="create-procedure" class="flex flex-col gap-4" @submit="submit">
        <VeeField name="name" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Nama Tindakan</FieldLabel>
                <FieldContent>
                    <Input v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map((err) => ({
                    message: err
                }))"/>
            </Field>
        </VeeField>
        <Field>
            <FieldLabel>Kode Tindakan</FieldLabel>
            <FieldContent>
                <Icd9Combobox placeholder="Cari ICD9" :items="codeItems" :model-value="form.values.code" @update:model-value="handleCodeSelection"/>
            </FieldContent>
        </Field>
    </form>
    <div class="mt-4">
        <Button form="create-procedure">Tambah Tindakan</Button>
    </div>
</template>
