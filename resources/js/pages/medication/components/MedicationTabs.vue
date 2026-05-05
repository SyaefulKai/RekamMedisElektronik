<script setup lang="ts">
import DataTable from '@/components/ui/datatable/DataTable.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { MedicationColumn } from '@/pages/medication/columns/medication-column';
import MedicationMasterForm from '@/pages/medication/components/MedicationMasterForm.vue';
import { Pagination } from '@/types';
import { Medication } from '@/types/resources/medication';
import { inject, Ref } from 'vue';


const medications = inject<Ref<Pagination<Medication>>>('medications')
</script>

<template>
    <Tabs default-value="master">
        <TabsList class="w-full justify-evenly gap-4">
            <TabsTrigger value="master" class="border w-full p-4">
                <div class="w-full">
                    Master Obat
                </div>
            </TabsTrigger>
            <TabsTrigger value="master-form" class="border w-full p-4">
                <div class="w-full">
                    Tambah Obat (Master)
                </div>
            </TabsTrigger>
            <TabsTrigger value="stock" class="border w-full p-4">
                <div class="w-full">
                    Tambah Stok Obat
                </div>
            </TabsTrigger>
        </TabsList>
        <TabsContent value="master">
            <DataTable :columns="MedicationColumn" :pagination="medications ?? []"/>
        </TabsContent>
        <TabsContent value="master-form">
            <div class="mt-4">
                <MedicationMasterForm />
            </div>
        </TabsContent>
        <TabsContent value="stock">
            Add medication stock here...
        </TabsContent>
    </Tabs>
</template>
