<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/Resources/PlanController';
import { Button } from '@/components/ui/button';
import { Combobox } from '@/components/ui/combobox';
import { Dialog, DialogDescription, DialogHeader, DialogScrollContent, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Field, FieldContent, FieldLabel } from '@/components/ui/field';
import { AddProcedureSchema, AddProcedureSchemaType } from '@/schemas/encounter';
import { router } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { Plus } from 'lucide-vue-next';
import { computed, inject, ref, Ref } from 'vue';
import { useForm } from 'vee-validate';
import { Procedure } from '@/types/resources/procedure';

const open = ref(false);
const schema = toTypedSchema(AddProcedureSchema);

const form = useForm({
  validationSchema: schema,
});

const encounter = inject<Ref<any>>('encounter');
const procedure_codes = inject<Ref<Procedure[]>>('procedures');
const procedureCodeItem = computed(() =>
  procedure_codes?.value.map((code) => ({
    label: code.name,
    value: code.code,
  })) ?? [],
);

const handleProcedureSelection = (value: string) => {
    const selectedItem = procedure_codes?.value.find((code) => code.code == value)
    if(!selectedItem) return;
    form.setFieldValue('code', selectedItem.code)
    form.setFieldValue('system', selectedItem.system)
    form.setFieldValue('display', selectedItem.display)
    form.setFieldValue('name', selectedItem.name)
}

const submit = form.handleSubmit((val: AddProcedureSchemaType) => {
  router.post(
    store({
      encounter: encounter?.value.uuid as string,
    }).url,
    {
      procedures: [val],
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
      <Button><Plus /> Tambah Tindakan</Button>
    </DialogTrigger>
    <DialogScrollContent>
      <DialogHeader>
        <DialogTitle>Tambah Tindakan</DialogTitle>
        <DialogDescription>Tambah tindakan pasien menggunakan kode ICD-9.</DialogDescription>
      </DialogHeader>
      <form id="procedure" class="flex flex-col gap-4" @submit="submit">
        <Field>
          <FieldLabel>Kode Tindakan</FieldLabel>
          <FieldContent>
            <Combobox
            :items="procedureCodeItem"
            @item:select="handleProcedureSelection"/>
          </FieldContent>
        </Field>
      </form>
      <div class="flex justify-end">
        <Button form="procedure">Simpan</Button>
      </div>
    </DialogScrollContent>
  </Dialog>
</template>
