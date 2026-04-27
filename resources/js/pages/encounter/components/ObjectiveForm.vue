<script setup lang="ts">
import { ButtonGroup, ButtonGroupText } from '@/components/ui/button-group';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { InputGroup, InputGroupInput } from '@/components/ui/input-group';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator';
import { Textarea } from '@/components/ui/textarea';
import BloodPressureInput from '@/pages/encounter/components/BloodPressureInput.vue';
import BMIInput from '@/pages/encounter/components/BMIInput.vue';
import { ObjectiveSchema, ObjectiveSchemaType } from '@/schemas/encounter';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm, Field as VeeField } from 'vee-validate';
import { router } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Resources/ObjectiveController';
import { Encounter } from '@/types/resources/encounter';
import { inject, Ref } from 'vue';
import { toast } from 'vue-sonner';
import { Button } from '@/components/ui/button';

const schema = toTypedSchema(ObjectiveSchema);

const encounter = inject<Ref<Encounter>>('encounter');

const form = useForm({
    validationSchema: schema,
    initialValues: {
        physical_examination: encounter?.value.objective?.physical_examination,
        vital_signs: {
            systolic: encounter?.value.objective?.vital_signs?.systolic,
            diastolic: encounter?.value.objective?.vital_signs?.diastolic,
            heart_rate: encounter?.value.objective?.vital_signs?.heart_rate,
            respiratory_rate: encounter?.value.objective?.vital_signs?.respiratory_rate,
            temperature: encounter?.value.objective?.vital_signs?.temperature,
            oxygen_saturation: encounter?.value.objective?.vital_signs?.oxygen_saturation,
            weight: encounter?.value.objective?.vital_signs?.weight,
            height: encounter?.value.objective?.vital_signs?.height,
        }
    }
});

const submit = form.handleSubmit((value: ObjectiveSchemaType) => {
    if(!encounter) {
        toast.error('Terjadi kesalahan, harap coba kembali beberapa saat.');
        return;
    }

    router.post(store({
        encounter: encounter?.value.uuid
    }).url, value, {
        onFlash: (flash) => {
            if(flash.objectiveCreated) toast.success(flash.objectiveCreated);
        }
    })
});
</script>

<template>
    <form id="objective" class="flex flex-col gap-4" @submit="submit">
        <VeeField name="physical_examination" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>
                    <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Pemeriksaan Fisik</h4>
                </FieldLabel>
                <Separator />
                <FieldContent>
                    <Textarea :model-value="field.value" @update:model-value="field.onChange" class="border border-border" />
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
        <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Tanda Vital</h4>
        <Separator />
        <div class="flex flex-col gap-4 lg:grid lg:grid-cols-2">
            <BloodPressureInput />
            <BMIInput />
        </div>
        <div class="flex flex-col gap-4 lg:grid lg:grid-cols-4">
            <VeeField name="vital_signs.heart_rate" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Detak Jantung</FieldLabel>
                    <FieldContent>
                        <ButtonGroup class="w-full !gap-0">
                            <InputGroup>
                                <InputGroupInput
                                    id="heart_rate"
                                    class="rounded-l border border-border"
                                    :model-value="field.value"
                                    @update:model-value="field.onChange"
                                />
                            </InputGroup>
                            <ButtonGroupText>
                                <Label for="heart_rate">bpm</Label>
                            </ButtonGroupText>
                        </ButtonGroup>
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
            <VeeField name="vital_signs.respiratory_rate" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Pernafasan</FieldLabel>
                    <FieldContent>
                        <ButtonGroup class="w-full !gap-0">
                            <InputGroup>
                                <InputGroupInput
                                    id="respiratory_rate"
                                    class="rounded-l border border-border"
                                    :model-value="field.value"
                                    @update:model-value="field.onChange"
                                />
                            </InputGroup>
                            <ButtonGroupText>
                                <Label for="respiratory_rate">/menit</Label>
                            </ButtonGroupText>
                        </ButtonGroup>
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
            <VeeField name="vital_signs.temperature" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Suhu</FieldLabel>
                    <FieldContent>
                        <ButtonGroup class="w-full !gap-0">
                            <InputGroup>
                                <InputGroupInput
                                    id="temperature"
                                    class="rounded-l border border-border"
                                    :model-value="field.value"
                                    @update:model-value="field.onChange"
                                />
                            </InputGroup>
                            <ButtonGroupText>
                                <Label for="temperature">&deg;C</Label>
                            </ButtonGroupText>
                        </ButtonGroup>
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
            <VeeField name="vital_signs.oxygen_saturaion" v-slot="{ field, errors }">
                <Field>
                    <FieldLabel>Saturasi Oksigen</FieldLabel>
                    <FieldContent>
                        <ButtonGroup class="w-full !gap-0">
                            <InputGroup>
                                <InputGroupInput
                                    id="oxygen_saturation"
                                    class="rounded-l border border-border"
                                    :model-value="field.value"
                                    @update:model-value="field.onChange"
                                />
                            </InputGroup>
                            <ButtonGroupText>
                                <Label for="oxygen_saturation">SpO<sub>2</sub></Label>
                            </ButtonGroupText>
                        </ButtonGroup>
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
    </form>
    <div class="flex justify-end mt-4">
        <Button form="objective">Simpan</Button>
    </div>
</template>
