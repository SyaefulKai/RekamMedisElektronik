<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { DateOfBirthCalendar } from '@/components/ui/calendar';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { NativeSelect, NativeSelectOption } from '@/components/ui/native-select';
import { CreatePatientSchema } from '@/schemas/patient';
import { toTypedSchema } from '@vee-validate/zod';
import { toDate } from 'radix-vue/date';
import { DateValue } from 'reka-ui';
import { Field as VeeField, useForm } from 'vee-validate';
import { z } from 'zod';

const schema = toTypedSchema(CreatePatientSchema);

const props = defineProps<{
    medical_record_number?: string;
}>();

const form = useForm({
    validationSchema: schema,
    initialValues: {
        medical_record_number: props.medical_record_number,
    },
});

const emit = defineEmits<{
    (e: 'submit', val: z.infer<typeof CreatePatientSchema>): void;
}>();

const submit = form.handleSubmit((data: z.infer<typeof CreatePatientSchema>) => {
    emit('submit', data);
});

const genders = {
    male: 'Laki-Laki',
    female: 'Perempuan',
};
const handleNIKField = (text: string, maxLength: number) => {
    const cleaned = text.replace(/[^0-9]/g, '');
    if (cleaned.length > 16) text.slice(0, -1);
    return form.setFieldValue('nik', cleaned.slice(0, maxLength));
};
</script>

<template>
    <div class="flex flex-col gap-4">
        <form id="create-patient" class="flex flex-col gap-4" @submit="submit">
            <div class="flex flex-col gap-4 md:grid md:grid-cols-2">
                <VeeField name="medical_record_number" v-slot="{ errors }">
                    <Field>
                        <FieldLabel> Nomor Rekam Medis </FieldLabel>
                        <FieldContent>
                            <Input :model-value="medical_record_number" :disabled="true" />
                        </FieldContent>
                        <FieldError
                            v-if="errors.length"
                            :errors="
                                errors.map((error) => ({
                                    message: error,
                                }))
                            "
                        />
                    </Field>
                </VeeField>
                <VeeField name="nik" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel> Nomor Induk Kependudukan </FieldLabel>
                        <FieldContent>
                            <Input v-bind="field" @input="(e: Event) => handleNIKField((e.target as HTMLInputElement).value, 16)" />
                        </FieldContent>
                        <FieldError
                            v-if="errors.length"
                            :errors="
                                errors.map((error) => ({
                                    message: error,
                                }))
                            "
                        />
                    </Field>
                </VeeField>
            </div>
            <div class="grid grid-cols-3 gap-4 items-center">
                <VeeField name="name" v-slot="{ field, errors }">
                    <Field>
                        <FieldLabel> Nama </FieldLabel>
                        <FieldContent>
                            <Input v-bind="field" />
                        </FieldContent>
                        <FieldError
                            v-if="errors.length"
                            :errors="
                                errors.map((error) => ({
                                    message: error,
                                }))
                            "
                        />
                    </Field>
                </VeeField>
                <VeeField name="gender" v-slot="{ errors }">
                    <Field>
                        <FieldLabel>Jenis Kelamin</FieldLabel>
                        <FieldContent>
                            <NativeSelect @change="(e: Event) => form.setFieldValue('gender', (e.target as HTMLSelectElement).value as any)">
                                <NativeSelectOption v-for="[key, label] in Object.entries(genders)" :key="key" :value="key">
                                    {{ label }}
                                </NativeSelectOption>
                            </NativeSelect>
                        </FieldContent>
                        <FieldError
                            v-if="errors.length"
                            :errors="
                                errors.map((error) => ({
                                    message: error,
                                }))
                            "
                        />
                    </Field>
                </VeeField>
                <VeeField name="birth_date" v-slot="{ errors }">
                    <Field>
                        <FieldLabel> Tanggal Lahir </FieldLabel>
                        <FieldContent>
                            <DateOfBirthCalendar @selected="(val: DateValue) => form.setFieldValue('birth_date', toDate(val))" />
                        </FieldContent>
                        <FieldError
                            v-if="errors.length"
                            :errors="
                                errors.map((error) => ({
                                    message: error,
                                }))
                            "
                        />
                    </Field>
                </VeeField>
            </div>
            <VeeField name="address" v-slot="{ field, errors }">
                <Field class="col-span-2">
                    <FieldLabel> Alamat </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" />
                    </FieldContent>
                    <FieldError
                        v-if="errors.length"
                        :errors="
                            errors.map((error) => ({
                                message: error,
                            }))
                        "
                    />
                </Field>
            </VeeField>
        </form>
        <div>
            <Button form="create-patient"> Tambah Pasien </Button>
        </div>
    </div>
</template>
