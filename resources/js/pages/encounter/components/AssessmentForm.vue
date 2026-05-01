<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { Icd10Column } from '@/pages/encounter/columns/assessment-column';
import DiagnosisDialog from '@/pages/encounter/components/DiagnosisDialog.vue';
import { Encounter } from '@/types/resources/encounter';
import { inject, Ref } from 'vue';

const encounter = inject<Ref<Encounter>>('encounter');
</script>

<template>
    <div>
        <div class="flex items-center justify-between mt-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Diagnosa</h4>
            <DiagnosisDialog />
        </div>
        <DataTable :columns="Icd10Column" :pagination="encounter?.assessment?.assessment_diagnoses ?? []" />
    </div>
</template>
