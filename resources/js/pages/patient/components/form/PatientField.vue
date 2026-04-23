<script setup lang="ts">
import { DateOfBirthCalendar } from '@/components/ui/calendar';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { NativeSelect, NativeSelectOption } from '@/components/ui/native-select';
import { toDate } from 'radix-vue/date';
import { DateValue } from 'reka-ui';
import { Field as VeeField, useFormContext } from 'vee-validate';

const props = defineProps<{
    prefix?: string
}>()


const prefixField = (name: string) => props.prefix ? `${props.prefix}.${name}` : name;

const form = useFormContext();

const genders = {
    male: 'Laki-Laki',
    female: 'Perempuan',
};

const handleNIKField = (text: string) => {
    const cleaned = text.replace(/[^0-9]/g, '');
    form.setFieldValue('nik', cleaned.slice(0, 16));
};
</script>

<template>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-4 md:grid md:grid-cols-2">
            <VeeField :name="prefixField('medical_record_number')" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Nomor Rekam Medis</FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" :disabled="true" />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>

            <VeeField :name="prefixField('nik')" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Nomor Induk Kependudukan</FieldLabel>
                    <FieldContent>
                        <Input
                            v-bind="field"
                            v-model="field.value"
                            @input="(e: Event) => handleNIKField((e.target as HTMLInputElement).value)"
                        />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>
        </div>

        <div class="grid grid-cols-3 items-center gap-4">
            <VeeField :name="prefixField('name')" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Nama</FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>

            <VeeField :name="prefixField('gender')" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Jenis Kelamin</FieldLabel>
                    <FieldContent>
                        <NativeSelect
                            v-model="field.value"
                            @change="(e: Event) => form.setFieldValue(prefixField('gender'), (e.target as HTMLSelectElement).value as any)"
                        >
                            <NativeSelectOption
                                v-for="[key, label] in Object.entries(genders)"
                                :key="key"
                                :value="key"
                            >
                                {{ label }}
                            </NativeSelectOption>
                        </NativeSelect>
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>

            <VeeField :name="prefixField('birth_date')" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Tanggal Lahir</FieldLabel>
                    <FieldContent>
                        <DateOfBirthCalendar
                            :default-date="field.value"
                            v-model="field.value"
                            @selected="(val: DateValue) => form.setFieldValue(prefixField('birth_date'), toDate(val))"
                        />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
            <VeeField :name="prefixField('address')" v-slot="{ field, errors }">
                <Field class="flex-1">
                    <FieldLabel>Alamat</FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>

            <VeeField :name="prefixField('occupation')" v-slot="{ field, errors }">
                <Field class="flex-1">
                    <FieldLabel>Pekerjaan</FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
                    </FieldContent>
                    <FieldError v-if="errors.length" :errors="errors.map(message => ({ message }))" />
                </Field>
            </VeeField>
        </div>
    </div>
</template>
