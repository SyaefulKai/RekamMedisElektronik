<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm, Field as VeeField } from 'vee-validate';
import { z } from 'zod';
import PermissionList from './PermissionList.vue';
import { CreateRoleRequest } from '@/types/authorization/role';

const schema = toTypedSchema(
    z.object({
        name: z.string({
            message: 'Nama role harus ada.',
        }),
        permissions: z.array(z.string()).optional(),
    }),
);

const form = useForm({
    validationSchema: schema,
});

const emit = defineEmits<{
    (e: 'submitted', val: CreateRoleRequest): void
}>()

const submit = form.handleSubmit((data: CreateRoleRequest) => {
    emit('submitted', data)
});
</script>

<template>
    <div class="flex flex-col">
        <div>
            <form id="role" @submit="submit" class="m-8 flex flex-col gap-4">
                <VeeField v-slot="{ field, errors }" name="name">
                    <Field>
                        <FieldLabel>Nama Peran</FieldLabel>
                        <FieldContent>
                            <Input v-bind="field" autocomplete="off" :aria-invalid="!!errors.length" />
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
                <VeeField name="permissions" v-slot="{ errors }">
                    <Field>
                        <FieldLabel>Izin Peran</FieldLabel>
                        <FieldContent>
                            <div class="flex flex-col gap-4 md:grid md:grid-cols-3">
                                <PermissionList :permissions="[]" @checked="(val) => form.setFieldValue('permissions', val)" />
                            </div>
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
        </div>
        <div class="grid mx-8 pb-8 md:flex md:justify-end md:pb-4 md:mx-8">
            <Button type="submit" form="role">Buat</Button>
        </div>
    </div>
</template>
