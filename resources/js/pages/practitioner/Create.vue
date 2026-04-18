<script setup lang="ts">
import { create, index } from '@/actions/App/Http/Controllers/Resources/PractitionerController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { Head } from '@inertiajs/vue3';

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
</script>

<template>
    <Head title="Jadikan Praktisi"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        
    </AppLayout>
</template>
