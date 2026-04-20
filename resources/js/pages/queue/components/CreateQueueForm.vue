<script setup lang="ts">
import { DateOfBirthCalendar } from '@/components/ui/calendar';
import { Combobox } from '@/components/ui/combobox';
import { Field, FieldContent, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { NativeSelect, NativeSelectOption } from '@/components/ui/native-select';
import { Separator } from '@/components/ui/separator';
import { CreateQueueSchema } from '@/types/queue';
import { Patient } from '@/types/resources/patient';
import { Practitioner } from '@/types/resources/practitioner';
import { toTypedSchema } from '@vee-validate/zod';
import { toDate } from 'radix-vue/date';
import { DateValue } from 'reka-ui';
import { useForm, Field as VeeField } from 'vee-validate';
import { computed } from 'vue';

const props = defineProps<{
    patient: Patient;
    practitioners: Practitioner[]
}>();

const schema = toTypedSchema(CreateQueueSchema);

const form = useForm({
    validationSchema: schema,
    initialValues: {
        patient: {
            name: props.patient.name,
            nik: props.patient.nik,
            address: props.patient.address,
            occupation: props.patient.occupation,
            birth_date: new Date(props.patient.birth_date),
            medical_record_number: props.patient.medical_record_number,
            gender: props.patient.gender,
        },
    },
});

const genders = {
    male: 'Laki-Laki',
    female: 'Perempuan',
};

const handleNIKField = (text: string, maxLength: number) => {
    const cleaned = text.replace(/[^0-9]/g, '');
    if (cleaned.length > 16) text.slice(0, -1);
    return form.setFieldValue('patient.nik', cleaned.slice(0, maxLength));
};

const practitioners = computed(() => {
    return props.practitioners.map((practitioner) => ({
        value: String(practitioner.user.id),
        label: practitioner.user.name
    }))
})
</script>

<template>
    <form class="flex flex-col gap-4">
        <div class="flex flex-col gap-4 md:grid md:grid-cols-2">
            <VeeField name="patient.medical_record_number" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel> Nomor Rekam Medis </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" :disabled="true" />
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
            <VeeField name="patient.nik" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel> Nomor Induk Kependudukan </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" @input="(e: Event) => handleNIKField((e.target as HTMLInputElement).value, 16)" />
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
        <div class="grid grid-cols-3 items-center gap-4">
            <VeeField name="patient.name" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel> Nama </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
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
            <VeeField name="patient.gender" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Jenis Kelamin</FieldLabel>
                    <FieldContent>
                        <NativeSelect
                            v-model="field.value"
                            @change="(e: Event) => form.setFieldValue('patient.gender', (e.target as HTMLSelectElement).value as any)"
                        >
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
            <VeeField name="patient.birth_date" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel> Tanggal Lahir </FieldLabel>
                    <FieldContent>
                        <DateOfBirthCalendar
                            :default-date="field.value"
                            @selected="(val: DateValue) => form.setFieldValue('patient.birth_date', toDate(val))"
                            v-model="field.value"
                        />
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
        <div class="flex flex-col gap-4 md:flex-row">
            <VeeField name="patient.address" v-slot="{ field, errors }">
                <Field class="col-span-2">
                    <FieldLabel> Alamat </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
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
            <VeeField name="patient.occupation" v-slot="{ field, errors }">
                <Field class="col-span-2">
                    <FieldLabel> Pekerjaan </FieldLabel>
                    <FieldContent>
                        <Input v-bind="field" v-model="field.value" />
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
        <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Pengaturan Antrian</h4>
        <Separator />
        <Combobox placeholder="Pilih Praktisi" :items="practitioners"/>
    </form>
</template>
