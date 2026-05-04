
<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { ProcedureColumn } from '@/pages/encounter/columns/procedure-column';
import { inject, Ref } from 'vue';
import { Encounter } from '@/types/resources/encounter';
import ProcedureDialog from '@/pages/encounter/components/ProcedureDialog.vue';

const encounter = inject<Ref<Encounter>>('encounter');
const columns = ProcedureColumn(encounter?.value)
</script>

<template>
    <div>
        <div class="flex items-center justify-between mt-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Tindakan</h4>
            <ProcedureDialog />
        </div>
        <DataTable :columns="columns" :pagination="encounter?.plan?.procedures ?? []" />
    </div>
</template>
