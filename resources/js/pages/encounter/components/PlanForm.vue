<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { MedicationColumn } from '@/pages/encounter/columns/medication-column';
import { ProcedureColumn } from '@/pages/encounter/columns/procedure-column';
import MedicationDialog from '@/pages/encounter/components/MedicationDialog.vue';
import ProcedureDialog from '@/pages/encounter/components/ProcedureDialog.vue';
import { Encounter } from '@/types/resources/encounter';
import { inject, ref, Ref } from 'vue';

const encounter = inject<Ref<Encounter>>('encounter');
const procedureColumn = ProcedureColumn(encounter?.value as Encounter);
const medicationColumn = MedicationColumn(encounter?.value as Encounter);
const activeTab = ref('tindakan');
</script>

<template>
    <Tabs v-model="activeTab">
        <TabsList class="w-full gap-4 bg-transparent">
            <TabsTrigger
                value="tindakan"
                class="w-full border-b bg-transparent"
                :class="{
                    'border-white': activeTab == 'tindakan',
                }"
            >
                Tindakan
            </TabsTrigger>
            <TabsTrigger
                value="obat"
                class="w-full border-b bg-transparent"
                :class="{
                    'border-white': activeTab == 'obat',
                }"
            >
                Obat
            </TabsTrigger>
        </TabsList>
        <TabsContent value="tindakan">
            <div>
                <div class="mt-4 flex items-center justify-end">
                    <ProcedureDialog />
                </div>
                <DataTable :columns="procedureColumn" :pagination="encounter?.plan?.procedures ?? []" />
            </div>
        </TabsContent>
        <TabsContent value="obat">
            <div>
                <div class="mt-4 flex items-center justify-end">
                    <MedicationDialog />
                </div>
                <DataTable :columns="medicationColumn" :pagination="encounter?.plan?.medications ?? []" />
            </div>
        </TabsContent>
    </Tabs>
    <!-- <div>
        <div class="flex items-center justify-between mt-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Tindakan</h4>
            <ProcedureDialog />
        </div>
        <DataTable :columns="columns" :pagination="encounter?.plan?.procedures ?? []" />
    </div>
    <div>
        <div class="flex items-center justify-between mt-4">
            <h4 class="scroll-m-20 text-xl font-semibold tracking-tight">Obat</h4>
            <ProcedureDialog />
        </div>
        <DataTable :columns="columns" :pagination="encounter?.plan?.procedures ?? []" />
    </div> -->
</template>
