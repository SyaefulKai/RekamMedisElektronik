<script setup lang="ts">
import { create, index, store } from '@/actions/App/Http/Controllers/Resources/PractitionerController';
import AppLayout from '@/layouts/AppLayout.vue';
import CreatePractitionerForm from '@/pages/practitioner/components/CreatePractitionerForm.vue';
import { CreatePractitionerSchema } from '@/schemas/practitioner';
import { BreadcrumbItem, User } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { z } from 'zod';

const props = defineProps<{
    user: User
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Praktisi',
        href: index().url
    },
    {
        title: 'Jadikan Praktisi',
        href: create({
            user: props.user.id
        }).url
    }
]

const handleSubmit = (val: z.infer<typeof CreatePractitionerSchema>) => {
    router.post(store({
        user: props.user.id
    }).url, val)
}
</script>

<template>
    <Head title="Jadikan Praktisi"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <CreatePractitionerForm @submit="handleSubmit"/>
    </AppLayout>
</template>
