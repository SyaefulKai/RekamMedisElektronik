<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import { useProcedureCode } from '@/composables/useProcedureCode';
import AppLayout from '@/layouts/AppLayout.vue';
import EncounterTabs from '@/pages/encounter/components/EncounterTabs.vue';
import PatientDetail from '@/pages/encounter/components/PatientDetail.vue';
import { BreadcrumbItem } from '@/types';
import { DiagnosisCode, Encounter } from '@/types/resources/encounter';
import { Procedure } from '@/types/resources/procedure';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { provide, toRef } from 'vue';

const props = defineProps<{
    encounter: Encounter,
    diagnosis_codes: DiagnosisCode[],
    procedures: Procedure[],
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

const procedure = useProcedureCode()
const searchProcedure = (query: Record<string, any>) => {
    procedure.search(
        index(
            {
                encounter: props.encounter.uuid
            }
        ),
        query
    )
}

provide('encounter', toRef(props, 'encounter'))
provide('diagnosis_codes', toRef(props, 'diagnosis_codes'))
provide('procedures', toRef(props, 'procedures'))
provide('search_diagnosis', searchDiagnosis)
provide('search_procedure_code', searchProcedure)
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
