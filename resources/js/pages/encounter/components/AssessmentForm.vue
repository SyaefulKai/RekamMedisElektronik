<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { Icd10Column } from '@/pages/encounter/columns/assessment-column';
import DiagnosisDialog from '@/pages/encounter/components/DiagnosisDialog.vue';
import { Encounter } from '@/types/resources/encounter';
import { inject, Ref } from 'vue';

const encounter = inject<Ref<Encounter>>('encounter')

</script>

<template>
    <div>
        <div class="flex justify-end">
            <DiagnosisDialog />
        </div>
        <DataTable :columns="Icd10Column" :pagination="encounter?.assessment?.assessment_diagnoses ?? []"/>
    </div>
</template>
