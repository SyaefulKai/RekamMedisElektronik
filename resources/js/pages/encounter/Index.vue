<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import AppLayout from '@/layouts/AppLayout.vue';
import EncounterTabs from '@/pages/encounter/components/EncounterTabs.vue';
import PatientDetail from '@/pages/encounter/components/PatientDetail.vue';
import { BreadcrumbItem } from '@/types';
import { DiagnosisCode, Encounter } from '@/types/resources/encounter';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { provide, toRef } from 'vue';

const props = defineProps<{
    encounter: Encounter,
    diagnosis_codes: DiagnosisCode[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Rekam Medis',
        href: index({
            encounter: props.encounter.uuid
        }).url
    }
]

const searchDiagnosis = useDebounceFn((value: string) => {
    router.get(index({
        encounter: props.encounter.uuid
    }).url, {
        filter: {
            query: value
        },
    }, {
        preserveState: true,
        preserveScroll: true,
        only: [
            'diagnosis_codes'
        ]
    })
}, 500)

provide('encounter', toRef(props, 'encounter'))
provide('diagnosis_codes', toRef(props, 'diagnosis_codes'))
provide('search_diagnosis', searchDiagnosis)
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
