<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Combobox, RekaCombobox } from '@/components/ui/combobox';
import { Dialog, DialogDescription, DialogHeader, DialogScrollContent, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { DiagnosisRole } from '@/constant/assessment';
import { Icd10Schema, Icd10SchemaType } from '@/schemas/encounter';
import { Pagination } from '@/types';
import { Encounter, Icd10 } from '@/types/resources/encounter';
import { toTypedSchema } from '@vee-validate/zod';
import { Plus } from 'lucide-vue-next';
import { useForm, Field as VeeField } from 'vee-validate';
import { computed, inject, ref, Ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Resources/AssessmentController';

const open = ref(false)

const schema = toTypedSchema(Icd10Schema);

const diagnosisTypeItem = Object.entries(DiagnosisRole).map((value) => ({
    label: value[1],
    value: value[0],
}));

const icd10sPagination = inject<Ref<Pagination<Icd10>>>('icd10s');

const icd10s = computed(
    () =>
        icd10sPagination?.value.data.map((icd10) => ({
            label: `${icd10.icd10_code} - ${icd10.icd10_id}`,
            value: String(icd10.id),
        })) ?? [],
);

const searchIcd10 = inject<(value: string) => void>('icd10_search');

const form = useForm({
    validationSchema: schema,
});

const encounter = inject<Ref<Encounter>>('encounter')

const submit = form.handleSubmit((val: Icd10SchemaType) => {
    router.post(store({
        encounter: encounter?.value.uuid as string
    }).url, {
        icd10s: [
            val
        ]
    }, {
        onFinish: () => {
            open.value = false
        }
    })
})
</script>

<template>
    <Dialog :open="open" @update:open="open = $event">
        <DialogTrigger>
            <Button><Plus /> Tambah Diagnosa</Button>
        </DialogTrigger>
        <DialogScrollContent>
            <DialogHeader>
                <DialogTitle>Tambah Diagnosa</DialogTitle>
                <DialogDescription>Tambah diagnosa pasien menggunakan kode ICD10.</DialogDescription>
            </DialogHeader>
            <form id="icd10" class="flex flex-col gap-4" @submit="submit">
                <VeeField name="diagnosis_type" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Tipe Diagnosa</FieldLabel>
                        <FieldContent>
                            <Combobox @item:select="(value) => field.onChange(value)" :items="diagnosisTypeItem" placeholder="Tipe diagnosa" />
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
                <VeeField name="icd10" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>ICD 10</FieldLabel>
                        <FieldContent>
                            <RekaCombobox :items="icd10s" @search="searchIcd10" v-model="field.value" @update:model-value="field.onChange" />
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
            <div class="flex justify-end">
                <Button form="icd10">Simpan</Button>
            </div>
        </DialogScrollContent>
    </Dialog>
</template>
