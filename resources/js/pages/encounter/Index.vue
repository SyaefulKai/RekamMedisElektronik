<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import AppLayout from '@/layouts/AppLayout.vue';
import EncounterTabs from '@/pages/encounter/components/EncounterTabs.vue';
import PatientDetail from '@/pages/encounter/components/PatientDetail.vue';
import { BreadcrumbItem, Pagination } from '@/types';
import { Encounter, Icd10 } from '@/types/resources/encounter';
import { Head } from '@inertiajs/vue3';
import { provide, toRef } from 'vue';

const props = defineProps<{
    encounter: Encounter,
    icd10s: Pagination<Icd10>
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Rekam Medis',
        href: index({
            encounter: props.encounter.uuid
        }).url
    }
]

provide('encounter', toRef(props, 'encounter'))
provide('icd10s', props.icd10s.data)
</script>

<template>
    <Head title="Rekam Medis"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-8 flex flex-col gap-4">
            <PatientDetail v-if="encounter.patient" :patient="encounter.patient"/>
            <EncounterTabs />
        </div>
    </AppLayout>
</template>
