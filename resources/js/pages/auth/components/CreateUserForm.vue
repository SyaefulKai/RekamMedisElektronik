<script setup lang="ts">
import { Field as VeeField, useForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/zod';
import { z } from 'zod';
import { Field, FieldContent, FieldError, FieldLabel } from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Role } from '@/types';
import RoleList from '@/pages/authorization/roles/components/RoleList.vue';
import { Button } from '@/components/ui/button';
import { CreateUserSchema } from '@/schemas/user';

const schema = toTypedSchema(CreateUserSchema)

const form = useForm({
    validationSchema: schema
})

defineProps<{
    roles: Role[]
}>()

const emit = defineEmits<{
    (e: 'submit', val: z.infer<typeof CreateUserSchema>): void
}>()

const submit = form.handleSubmit((data) => {
    emit('submit', data);
})

</script>

<template>
    <form id="create-user" class="flex flex-col gap-4" @submit="submit">
        <VeeField name="name" v-slot="{field, errors}">
            <Field>
                <FieldLabel>Nama</FieldLabel>
                <FieldContent>
                    <Input v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(error => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
        <VeeField name="email" v-slot="{field, errors}">
            <Field>
                <FieldLabel>Email</FieldLabel>
                <FieldContent>
                    <Input type="email" v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(error => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
        <VeeField name="password" v-slot="{field, errors}">
            <Field>
                <FieldLabel>Password</FieldLabel>
                <FieldContent>
                    <Input type="password" v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(error => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
        <VeeField name="role" v-slot="{field, errors}">
            <Field>
                <FieldLabel>Role</FieldLabel>
                <FieldContent>
                    <RoleList :roles="roles" v-bind="field"/>
                </FieldContent>
                <FieldError v-if="errors.length" :errors="errors.map(error => ({
                    message: error
                }))"/>
            </Field>
        </VeeField>
    </form>
    <div class="mt-4 grid md:flex md:justify-end">
        <Button form="create-user">Tambah Pengguna</Button>
    </div>
</template>
