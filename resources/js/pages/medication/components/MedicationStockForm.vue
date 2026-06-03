<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useFieldArray, useForm, Field as VeeField } from 'vee-validate';
import { computed, inject, ref, Ref } from 'vue';
import { toast } from 'vue-sonner';
import { Plus, Trash2, Copy } from 'lucide-vue-next';
import { z } from 'zod';

import { Button } from '@/components/ui/button';
import { Combobox, ComboboxItem, RekaCombobox } from '@/components/ui/combobox';
import { Field, FieldContent, FieldError, FieldLabel, FieldDescription } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import DateOfBirthCalendar from '@/components/ui/calendar/DateOfBirthCalendar.vue';
import { getLocalTimeZone } from '@internationalized/date';

import { bulkStore, create } from '@/actions/App/Http/Controllers/Resources/MedicationStockController';
import { AddMedicationStockSchema } from '@/schemas/medication';
import { Pagination } from '@/types';
import { Medication } from '@/types/resources/medication';
import { useDebounceFn } from '@vueuse/core';

const schema = toTypedSchema(z.object({ medications: AddMedicationStockSchema }));

type StockItem = {
  medication_id: number | undefined;
  batch_number: string | null;
  expired_at: string | null;
  quantity: number | null;
  buy_price: number | null;
  sell_price: number | null;
};

const emptyRow = (): StockItem => ({ medication_id: undefined, batch_number: null, expired_at: null, quantity: null, buy_price: null, sell_price: null });

const form = useForm<{ medications: StockItem[] }>({
  validationSchema: schema,
  initialValues: { medications: [emptyRow()] },
});

const { fields, push, remove } = useFieldArray('medications');

const medications = inject<Ref<Pagination<Medication>> | null>('medications', null);

const medicationOptions = computed<ComboboxItem[]>(() => {
  return medications?.value?.data?.map((med) => ({
    label: med.trade_name
      ? `${med.trade_name} (${med.generic_name})`
      : med.generic_name,
    value: med.id,
  })) ?? [];
});

const onMedicationSearch = useDebounceFn((query: string) => {
  router.get(create().url, {
    filter: {
      name: query
    },
  }, {
    preserveState: true,
    replace: true
  });
}, 500);

const addRow = () => push(emptyRow());
const removeRow = (idx: number) => { if (fields.value.length <= 1) return; remove(idx); };
const cloneRow = (idx: number) => { const row = form.values.medications?.[idx]; if (!row) return; push({ ...row }); };

const formatCurrency = (value: number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value || 0);

const totalRows = computed(() => fields.value.length);
const totalQuantity = computed(() => (form.values.medications ?? []).reduce((acc, it) => acc + (Number(it?.quantity) || 0), 0));
const totalValue = computed(() => (form.values.medications ?? []).reduce((acc, it) => acc + (Number(it?.quantity) || 0) * (Number(it?.buy_price) || 0), 0));

const daysUntil = (dateStr?: string | null) => {
  if (!dateStr) return null;
  const d = new Date(dateStr);
  const diff = Math.ceil((d.getTime() - new Date().getTime()) / (1000 * 60 * 60 * 24));
  return diff;
};

const canSubmit = computed(() => {
  return (form.values.medications ?? []).some((it) => Boolean(it.medication_id && it.quantity && it.buy_price && it.sell_price));
});

const submit = form.handleSubmit((val) => {
  router.post(bulkStore().url, val, {
    preserveScroll: true,
    onFlash: (flash) => {
      toast.success(flash.medicationStockCreated as string);
      form.resetForm({ values: { medications: [emptyRow()] } });
    },
  });
});
</script>

<template>
  <form id="medication-stock-form" class="flex flex-col gap-4" @submit="submit">
    <div v-for="(f, idx) in fields" :key="f.key" class="rounded-md border p-4 transition hover:shadow-sm">
      <div class="mb-3 flex items-start justify-between">
        <div class="text-sm font-medium">Baris {{ idx + 1 }}</div>
        <div class="flex gap-2">
          <Button type="button" variant="ghost" size="sm" @click="cloneRow(idx)">
            <Copy class="size-4" />
          </Button>
          <Button type="button" variant="ghost" size="sm" @click="removeRow(idx)" :disabled="fields.length === 1">
            <Trash2 class="size-4" />
          </Button>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div class="md:col-span-2">
          <VeeField :name="`medications.${idx}.medication_id`" v-slot="{ errors }">
            <Field orientation="responsive" :data-invalid="errors.length > 0">
              <FieldLabel>Nama Obat</FieldLabel>
              <FieldContent>
                <RekaCombobox :items="medicationOptions" :server-search="true" placeholder="Cari nama obat..."
                  @search="onMedicationSearch" v-model="form.values.medications[idx].medication_id" @update:model-value="(val: string | number) => {
                    form.setFieldValue(`medications[${idx}].medication_id` as any, Number(val))
                  }" />
              </FieldContent>
              <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
            </Field>
          </VeeField>
        </div>

        <div class="md:col-span-2">
          <VeeField :name="`medications.${idx}.batch_number`" v-slot="{ field, errors }">
            <Field orientation="responsive" :data-invalid="errors.length > 0">
              <FieldLabel>No. Batch</FieldLabel>
              <FieldContent>
                <Input v-bind="field" placeholder="Opsional" />
              </FieldContent>
              <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
            </Field>
          </VeeField>
        </div>

        <div class="md:col-span-2">
          <VeeField :name="`medications.${idx}.expired_at`" v-slot="{ field, errors }">
            <Field orientation="responsive" :data-invalid="errors.length > 0">
              <FieldLabel>Tanggal Kadaluarsa</FieldLabel>
              <FieldContent>
                <DateOfBirthCalendar :defaultDate="field.value ? new Date(field.value) : undefined" @selected="(val) => {
                  form.setFieldValue(
                    `medications[${idx}].expired_at` as any,
                    val.toDate(getLocalTimeZone()).toISOString()
                  )
                }" />
              </FieldContent>
              <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
            </Field>
          </VeeField>
        </div>

        <div class="md:col-span-2">
          <VeeField :name="`medications.${idx}.quantity`" v-slot="{ field, errors }">
            <Field orientation="responsive" :data-invalid="errors.length > 0">
              <FieldLabel>Jumlah</FieldLabel>
              <FieldContent>
                <Input v-bind="field" type="number" min="1" placeholder="0" />
              </FieldContent>
              <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
            </Field>
          </VeeField>
        </div>

        <div class="md:col-span-4">
          <div class="grid grid-cols-2 gap-2">
            <VeeField :name="`medications.${idx}.buy_price`" v-slot="{ field, errors }">
              <Field orientation="responsive" :data-invalid="errors.length > 0">
                <FieldLabel>Harga Beli</FieldLabel>
                <FieldContent>
                  <div class="relative">
                    <span
                      class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-muted-foreground">Rp</span>
                    <Input v-bind="field" type="number" min="1" placeholder="0" class="pl-9" />
                  </div>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
              </Field>
            </VeeField>

            <VeeField :name="`medications.${idx}.sell_price`" v-slot="{ field, errors }">
              <Field orientation="responsive" :data-invalid="errors.length > 0">
                <FieldLabel>Harga Jual</FieldLabel>
                <FieldContent>
                  <div class="relative">
                    <span
                      class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-muted-foreground">Rp</span>
                    <Input v-bind="field" type="number" min="1" placeholder="0" class="pl-9" />
                  </div>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map((err) => ({ message: err }))" />
              </Field>
            </VeeField>
          </div>
        </div>
      </div>
    </div>

    <div class="sticky bottom-0 z-10 mt-3 backdrop-blur-sm py-3 border-t flex items-center justify-between">
      <div class="text-sm text-muted-foreground">Total: <span class="font-semibold">{{ totalQuantity }}</span> items —
        <span class="font-semibold">{{ formatCurrency(totalValue) }}</span>
      </div>
      <div class="flex items-center gap-2">
        <Button type="button" variant="ghost" @click="addRow">Tambah baris</Button>
      </div>
    </div>
  </form>
</template>
