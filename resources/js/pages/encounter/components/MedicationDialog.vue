<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/Resources/PlanController';
import { Button } from '@/components/ui/button';
import { RekaCombobox } from '@/components/ui/combobox';
import { Dialog, DialogDescription, DialogHeader, DialogScrollContent, DialogTitle, DialogTrigger } from '@/components/ui/dialog';

import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';

import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

import { Input } from '@/components/ui/input';
import { AddMedicationSchema, AddMedicationSchemaType } from '@/schemas/encounter';
import { Medication } from '@/types/resources/medication';
import { router } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { Plus } from 'lucide-vue-next';
import { useForm, Field as VeeField } from 'vee-validate';
import { computed, inject, ref, Ref } from 'vue';

import { aturanPakaiOptions } from '@/constant/medication';
import { Pagination } from '@/types';

const open = ref(false);

const form = useForm({
    validationSchema: toTypedSchema(AddMedicationSchema),
});

const encounter = inject<Ref<any>>('encounter');
const medications = inject<Ref<Pagination<Medication>>>('medications');

const medicationItem = computed(
    () =>
        medications?.value.data.map((med) => ({
            label: `${med.trade_name} (${med.generic_name}) - ${med.strength} ${med.unit}`,
            value: String(med.id),
        })) ?? [],
);

const searchMedication = inject<(val: string | number) => void>('search_medication');

const submit = form.handleSubmit((val: AddMedicationSchemaType) => {
    router.post(
        store({
            encounter: encounter?.value.uuid as string,
        }).url,
        {
            medications: [val],
        },
        {
            onFinish: () => {
                open.value = false;
                form.resetForm();
            },
        },
    );
});
</script>

<template>
    <Dialog :open="open" @update:open="open = $event">
        <DialogTrigger>
            <Button> <Plus /> Tambah Obat </Button>
        </DialogTrigger>

        <DialogScrollContent>
            <DialogHeader>
                <DialogTitle>Tambah Obat</DialogTitle>
                <DialogDescription>Tambah resep obat untuk rencana terapi pasien.</DialogDescription>
            </DialogHeader>

            <form id="medication" class="flex flex-col gap-4" @submit="submit">
                <!-- OBAT -->
                <VeeField name="medication_id" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Pilih Obat</FieldLabel>

                        <FieldContent>
                            <!-- <Combobox :items="medicationItem" placeholder="Pilih obat" @item:select="handleMedicationSelect" @input:search="searchMedication"/> -->
                            <RekaCombobox
                                :items="medicationItem"
                                v-model="field.value"
                                @update:model-value="field.onChange"
                                @search="searchMedication"
                            />
                        </FieldContent>

                        <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
                    </Field>
                </VeeField>

                <!-- DOSIS -->
                <!-- <VeeField name="dose" v-slot="{ field, errors }">
          <Field>
            <FieldLabel>Dosis</FieldLabel>
            <FieldContent>
              <Input type="number" step="0.01" min="0" class="w-full border rounded px-3 py-2" placeholder="Contoh: 500" v-bind="field" />
            </FieldContent>
            <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
          </Field>
        </VeeField> -->

                <div class="flex gap-4">
                    <!-- FREKUENSI PER HARI -->
                    <VeeField name="frequency_per_day" v-slot="{ field, errors }">
                        <Field>
                            <FieldLabel>Frekuensi per Hari</FieldLabel>
                            <FieldContent>
                                <Input
                                    type="number"
                                    min="1"
                                    max="10"
                                    class="w-full rounded border px-3 py-2"
                                    placeholder="Contoh: 3"
                                    v-bind="field"
                                />
                            </FieldContent>
                            <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
                        </Field>
                    </VeeField>

                    <!-- FREKUENSI PER HARI -->
                    <VeeField name="dose_per_take" v-slot="{ field, errors }">
                        <Field>
                            <FieldLabel>Jumlah Obat per Konsumsi</FieldLabel>
                            <FieldContent>
                                <Input
                                    type="number"
                                    min="1"
                                    max="10"
                                    class="w-full rounded border px-3 py-2"
                                    placeholder="Contoh: 1"
                                    v-bind="field"
                                />
                            </FieldContent>
                            <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
                        </Field>
                    </VeeField>
                </div>

                <!-- ATURAN PAKAI (instruction) -->
                <VeeField name="instruction" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Aturan Pakai</FieldLabel>
                        <FieldContent>
                            <Select :model-value="field.value" @update:model-value="field.onChange">
                                <SelectTrigger>
                                    <SelectValue placeholder="Pilih aturan pakai" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="aturan in aturanPakaiOptions" :key="aturan.value" :value="aturan.value">
                                        {{ aturan.label }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                        </FieldContent>
                        <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
                    </Field>
                </VeeField>

                <VeeField name="quantity" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel>Jumlah</FieldLabel>
                        <FieldContent>
                            <Input type="number" min="1" class="w-full rounded border px-3 py-2" placeholder="Total tablet/kapsul" v-bind="field" />
                        </FieldContent>
                        <FieldError v-if="errors.length" :errors="errors.map((e) => ({ message: e }))" />
                    </Field>
                </VeeField>
            </form>

            <div class="flex justify-end gap-2">
                <Button type="button" variant="outline" @click="open = false">Batal</Button>
                <Button form="medication">Simpan</Button>
            </div>
        </DialogScrollContent>
    </Dialog>
</template>
