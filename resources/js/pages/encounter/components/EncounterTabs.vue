<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Tabs, TabsList, TabsTrigger, TabsContent } from '@/components/ui/tabs';
import AssessmentForm from '@/pages/encounter/components/AssessmentForm.vue';
import ObjectiveForm from '@/pages/encounter/components/ObjectiveForm.vue';
import PlanForm from '@/pages/encounter/components/PlanForm.vue';
import SubjectiveForm from '@/pages/encounter/components/SubjectiveForm.vue';
import { ref } from 'vue';

const state = ref("subjective")

</script>
<template>
    <Tabs v-model="state">
        <TabsList class="grid grid-cols-4 gap-4">
            <TabsTrigger value="subjective" as-child class="w-full p-0">
                <Button :variant="state == 'subjective' ? 'ghost' : 'secondary'" class="w-full border">Subjective</Button>
            </TabsTrigger>
            <TabsTrigger value="objective" as-child class="w-full p-0">
                <Button :variant="state == 'objective' ? 'ghost' : 'secondary'" class="w-full border">Objective</Button>
            </TabsTrigger>
            <TabsTrigger value="assessment" as-child class="w-full p-0">
                <Button :variant="state == 'assessment' ? 'ghost' : 'secondary'" class="w-full border">Assessment</Button>
            </TabsTrigger>
            <TabsTrigger value="plan" as-child class="w-full p-0">
                <Button :variant="state == 'plan' ? 'ghost' : 'secondary'" class="w-full border">Plan</Button>
            </TabsTrigger>
        </TabsList>
        <TabsContent value="subjective">
            <SubjectiveForm />
        </TabsContent>
        <TabsContent value="objective">
            <ObjectiveForm />
        </TabsContent>
        <TabsContent value="assessment">
            <AssessmentForm />
        </TabsContent>
        <TabsContent value="plan">
            <PlanForm />
        </TabsContent>
    </Tabs>
</template>
