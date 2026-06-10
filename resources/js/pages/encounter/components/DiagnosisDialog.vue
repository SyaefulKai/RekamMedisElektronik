<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/Resources/AssessmentController';
import { Button } from '@/components/ui/button';
import { Combobox, RekaCombobox } from '@/components/ui/combobox';
import { Dialog, DialogDescription, DialogHeader, DialogScrollContent, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { DiagnosisRole, DiagnosisRoleLabel, DiagnosisStatus, DiagnosisStatusLabel } from '@/constant/assessment';
import { AddDiagnosisSchema, AddDiagnosisSchemaType } from '@/schemas/encounter';
import { DiagnosisCode, Encounter } from '@/types/resources/encounter';
import { router } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { Plus } from 'lucide-vue-next';
import { useForm, Field as VeeField } from 'vee-validate';
import { computed, inject, ref, Ref } from 'vue';

const open = ref(false);

const schema = toTypedSchema(AddDiagnosisSchema);

const diagnosisRoleItem = Object.entries(DiagnosisRole).map((value) => ({
    label: DiagnosisRoleLabel[value[1]],
    value: value[1],
}));

const diagnosisStatusItem = Object.entries(DiagnosisStatus).map((value) => ({
    label: DiagnosisStatusLabel[value[1]],
    value: value[1],
}));

const form = useForm({
    validationSchema: schema,
});

const encounter = inject<Ref<Encounter>>('encounter');
const searchDiagnosis = inject<(value: string) => void>('search_diagnosis');

const diagnosis_codes = inject<Ref<DiagnosisCode[]>>('diagnosis_codes');
const diagnosisCodeItem = computed(
    () =>
    diagnosis_codes?.value.map((code) => ({
        label: `${code.code} - ${code.display}`,
        value: code.code,
    })) ?? [],
);

const mapSelectedDiagnosis = (selectedCode: string) => {
    const selected = diagnosis_codes?.value.find((code) => code.code === selectedCode);
    if (!selected) return;
    form.setFieldValue('code', selected.code);
    form.setFieldValue('display', selected.display);
    form.setFieldValue('system', selected.system);
};

const submit = form.handleSubmit((val: AddDiagnosisSchemaType) => {
    router.post(
        store({
            encounter: encounter?.value.uuid as string,
        }).url,
        {
            diagnoses: [val],
        },
        {
            onFinish: () => {
                open.value = false;
            },
        },
    );
});
</script>

<template>
    <Dialog :open="open" @update:open="open = $event">
        <DialogTrigger>
            <Button><Plus /> Tambah Diagnosa</Button>
        </DialogTrigger>
        <DialogScrollContent>
            <DialogHeader>
                <DialogTitle>Tambah Diagnosa</DialogTitle>
                <DialogDescription>Tambah diagnosa pasien menggunakan kode diagnosa.</DialogDescription>
            </DialogHeader>
            <form id="diagnosis" class="flex flex-col gap-4" @submit="submit">
                <VeeField name="diagnosis_role" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Tipe Diagnosa</FieldLabel>
                        <FieldContent>
                            <Combobox @item:select="(value) => field.onChange(value)" :items="diagnosisRoleItem" placeholder="Tipe diagnosa" />
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
                <VeeField name="diagnosis_status" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Status Diagnosa</FieldLabel>
                        <FieldContent>
                            <Combobox @item:select="field.onChange" :items="diagnosisStatusItem" placeholder="Status diagnosa" />
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
                <Field>
                    <FieldLabel>Kode Diagnosa</FieldLabel>
                    <FieldContent>
                        <RekaCombobox
                            v-model="form.values.code"
                            @update:model-value="mapSelectedDiagnosis"
                            :items="diagnosisCodeItem"
                            :server-search="true"
                            @search="searchDiagnosis"
                        />
                    </FieldContent>
                </Field>
            </form>
            <div class="flex justify-end">
                <Button form="diagnosis">Simpan</Button>
            </div>
        </DialogScrollContent>
    </Dialog>
</template>
