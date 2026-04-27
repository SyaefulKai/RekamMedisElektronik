<script setup lang="ts">
import { ButtonGroup, ButtonGroupText } from '@/components/ui/button-group';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { InputGroup, InputGroupInput } from '@/components/ui/input-group';
import { useFormContext, Field as VeeField } from 'vee-validate';

const form = useFormContext();

const calcBmi = (weight?: number | null, height?: number | null) => {
  if (!weight || !height) return undefined
  const heightInM = height / 100
  return Math.round((weight / heightInM ** 2) * 10) / 10
}

const bmiBorderClass = (bmi?: number) => {
  if (!bmi) return 'border-border'
  if (bmi < 18.5) return 'border-blue-400'
  if (bmi < 25)   return 'border-green-400'
  if (bmi < 30)   return 'border-yellow-400'
  return 'border-red-400'
}
</script>

<template>
    <div class="flex flex-col md:flex-row gap-4">
        <VeeField name="vital_signs.weight" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Berat Badan</FieldLabel>
                <FieldContent>
                    <ButtonGroup class="!gap-0 w-full">
                        <InputGroup>
                            <InputGroupInput class="border border-border rounded-l" :model-value="field.value" @update:model-value="field.onChange" />
                        </InputGroup>
                        <ButtonGroupText>kg</ButtonGroupText>
                    </ButtonGroup>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(err => ({ message: err }))" />
            </Field>
        </VeeField>

        <VeeField name="vital_signs.height" v-slot="{ field, errors }">
            <Field>
                <FieldLabel>Tinggi Badan</FieldLabel>
                <FieldContent>
                    <ButtonGroup class="!gap-0 w-full">
                        <InputGroup>
                            <InputGroupInput class="border border-border rounded-l" :model-value="field.value" @update:model-value="field.onChange" />
                        </InputGroup>
                        <ButtonGroupText>cm</ButtonGroupText>
                    </ButtonGroup>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(err => ({ message: err }))" />
            </Field>
        </VeeField>

        <Field>
            <FieldLabel>BMI</FieldLabel>
            <FieldContent>
                <Input
                    disabled
                    :class="['border', bmiBorderClass(calcBmi(form.values.vital_signs?.weight, form.values.vital_signs?.height))]"
                    :model-value="calcBmi(form.values.vital_signs?.weight, form.values.vital_signs?.height)"
                />
            </FieldContent>
        </Field>
    </div>
</template>
