<script setup lang="ts">
import { Combobox, ComboboxItem } from '@/components/ui/combobox';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import Separator from '@/components/ui/separator/Separator.vue';
import { Field as VeeField } from 'vee-validate';
import { inject } from 'vue';

defineProps<{
    practitioners: ComboboxItem[];
}>();

const searchPractitioner = inject('searchPractitioner', () => {})
</script>

<template>
    <div class="flex flex-col gap-4">
        <div>
            <h4 class="mb-2 scroll-m-20 text-xl font-semibold tracking-tight">Opsi Antrian</h4>
            <Separator />
        </div>
        <VeeField name="practitioner_id" v-slot="{field, errors}">
            <Field>
                <FieldLabel>Pilih Praktisi</FieldLabel>
                <FieldContent>
                    <Combobox :items="practitioners" @input:search="searchPractitioner" placeholder="Cari Praktisi" @item:select="(val) => field.onChange(Number(val))"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(error => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
    </div>
</template>
