<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import AppLayout from '@/layouts/AppLayout.vue';
import EncounterTabs from '@/pages/encounter/components/EncounterTabs.vue';
import PatientDetail from '@/pages/encounter/components/PatientDetail.vue';
import { BreadcrumbItem, Pagination } from '@/types';
import { Encounter, Icd10 } from '@/types/resources/encounter';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
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

const searchIcd10 = useDebounceFn((value: string) => {
    router.get(index({
        encounter: props.encounter.uuid
    }).url, {
        filter: {
            icd10_query: value
        },
    }, {
        preserveState: true,
        preserveScroll: true,
        only: [
            'icd10s'
        ]
    })
}, 500)

provide('encounter', toRef(props, 'encounter'))
provide('icd10s', toRef(props, 'icd10s'))
provide('icd10_search', searchIcd10)
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
