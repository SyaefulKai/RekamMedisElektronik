<script setup lang="ts">
import { ButtonGroup, ButtonGroupText } from '@/components/ui/button-group';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { InputGroup, InputGroupInput } from '@/components/ui/input-group';
import { useFormContext, Field as VeeField } from 'vee-validate';

useFormContext();
</script>

<template>
    <div class="flex gap-4">
        <VeeField name="vital_signs.systolic" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Sistol</FieldLabel>
                <FieldContent>
                    <ButtonGroup class="!gap-0 w-full">
                        <InputGroup>
                            <InputGroupInput class="border border-border rounded-l" :model-value="field.value" @update:model-value="field.onChange" />
                        </InputGroup>
                        <ButtonGroupText>mmHg</ButtonGroupText>
                    </ButtonGroup>
                </FieldContent>
                 <FieldError v-if="errors.length" :errors="errors.map(err => ({
                    message: err
                }))" />
            </Field>
        </VeeField>
        <VeeField name="vital_signs.diastolic" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Diastol</FieldLabel>
                <FieldContent>
                    <ButtonGroup class="!gap-0 w-full">
                        <InputGroup>
                            <InputGroupInput class="border border-border rounded-l" :model-value="field.value" @update:model-value="field.onChange" />
                        </InputGroup>
                        <ButtonGroupText>mmHg</ButtonGroupText>
                    </ButtonGroup>
                </FieldContent>
                 <FieldError v-if="errors.length" :errors="errors.map(err => ({
                    message: err
                }))" />
            </Field>
        </VeeField>
    </div>
</template>
