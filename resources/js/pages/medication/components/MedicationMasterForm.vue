<script setup lang="ts">
import { Combobox } from '@/components/ui/combobox';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { MedicationFormLabel, MedicationUnitLabel } from '@/constant/medication';
import { MedicationMasterSchema } from '@/schemas/medication';
import { MedicationMaster } from '@/types/resources/medication';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm, Field as VeeField } from 'vee-validate';
import { router } from '@inertiajs/vue3';
import { store } from '@/routes/medication';
import { Button } from '@/components/ui/button';
import { toast } from 'vue-sonner';

const schema = toTypedSchema(MedicationMasterSchema);

const form = useForm({
    validationSchema: schema,
});

const medicationUnitItems = Object.entries(MedicationUnitLabel).map((med) => ({
    label: med[1],
    value: med[0],
}));

const medicationFormItems = Object.entries(MedicationFormLabel).map(med => ({
    label: med[1],
    value: med[0]
}))

const submit = form.handleSubmit((val: MedicationMaster) => {
    router.post(store().url, val, {
        onFlash: (flash) => {
            toast.success(flash.medicationCreated as string)
            form.resetForm()
        },
        preserveState: false
    })
})
</script>

<template>
    <form id="medication-master" class="flex flex-col gap-4" @submit="submit">
        <VeeField name="generic_name" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Nama Generik Obat</FieldLabel>
                <FieldContent>
                    <Input v-bind="field" />
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
        <VeeField name="trade_name" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Nama Dagang Obat</FieldLabel>
                <FieldContent>
                    <Input v-bind="field" />
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
        <VeeField name="strength" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Kadar Zat Aktif</FieldLabel>
                <FieldContent>
                    <Input v-bind="field" placeholder="Contoh 500mg"/>
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
        <VeeField name="form" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Bentuk Fisik Obat</FieldLabel>
                <FieldContent>
                    <Combobox @item:select="field.onChange" :items="medicationFormItems" placeholder="Pilih bentuk fisik obat..." />
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
        <VeeField name="unit" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Satuan Obat</FieldLabel>
                <FieldContent>
                    <Combobox @item:select="field.onChange" :items="medicationUnitItems" placeholder="Pilih satuan obat..." />
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
    </form>
    <div class="mt-4">
        <Button form="medication-master">Simpan</Button>
        </div>
</template>
