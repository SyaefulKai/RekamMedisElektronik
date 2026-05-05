<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import MedicationTabs from '@/pages/medication/components/MedicationTabs.vue';
import { index } from '@/routes/medication';
import { BreadcrumbItem, Pagination } from '@/types';
import { Medication } from '@/types/resources/medication';
import { Head } from '@inertiajs/vue3';
import { provide, toRef } from 'vue';

const props = defineProps<{
    medications: Pagination<Medication>
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Obat',
        href: index().url
    }
]

provide('medications', toRef(props, 'medications'))
</script>

<template>
    <Head title="Obat" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8">
            <MedicationTabs />
        </div>
    </AppLayout>
</template>
