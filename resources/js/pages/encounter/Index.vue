<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Encounter } from '@/types/resources/encounter';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    encounter: Encounter
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Rekam Medis',
        href: index({
            encounter: props.encounter.uuid
        }).url
    }
]
</script>

<template>
    <Head title="Rekam Medis"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        
    </AppLayout>
</template>
