<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { computed, inject } from 'vue';
import { router } from '@inertiajs/vue3';
import type { Encounter } from '@/types/resources/encounter';
import type { Ref } from 'vue';
import { aturanPakaiOptions } from '@/constant/medication';

const encounter = inject<Ref<Encounter>>('encounter')!;
const data = computed(() => encounter.value);

const instructionLabelMap = computed(() => {
    const map: Record<string, string> = {};
    for (const opt of aturanPakaiOptions) {
        map[opt.value] = opt.label;
    }
    return map;
});

const mapInstruction = (value?: string | null): string => {
    if (!value) return '-';
    return instructionLabelMap.value[value] || value;
};

const finishEncounter = () => {
    if (data.value?.uuid) {
        router.put(`/encounters/${data.value.uuid}/finish`);
    }
};
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="flex items-center justify-between">
                <span>Ringkasan Rekam Medis</span>
                <Badge :variant="data?.status === 'finished' ? 'outline' : 'default'">
                    {{ data?.status === 'finished' ? 'Selesai' : 'Dalam Pemeriksaan' }}
                </Badge>
            </CardTitle>
        </CardHeader>
        <CardContent class="space-y-6">
            <!-- Subjective Summary -->
            <div v-if="data?.subjective?.chief_complaint || data?.subjective?.history_of_present_illness">
                <h4 class="mb-2 text-sm font-semibold text-muted-foreground uppercase tracking-wide">Subjective</h4>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">Keluhan Utama:</span> {{ data?.subjective?.chief_complaint || '-' }}</p>
                    <p><span class="font-medium">Riwayat Penyakit:</span> {{ data?.subjective?.history_of_present_illness || '-' }}</p>
                </div>
            </div>

            <Separator v-if="data?.subjective && data?.objective?.vital_signs" />

            <!-- Objective Summary -->
            <div v-if="data?.objective?.vital_signs">
                <h4 class="mb-2 text-sm font-semibold text-muted-foreground uppercase tracking-wide">Objective</h4>
                <div class="space-y-1 text-sm">
                    <p v-if="data?.objective?.vital_signs?.systolic || data?.objective?.vital_signs?.diastolic">
                        <span class="font-medium">TD:</span> {{ data?.objective?.vital_signs?.systolic || '-' }} / {{ data?.objective?.vital_signs?.diastolic || '-' }} mmHg
                    </p>
                    <p v-if="data?.objective?.vital_signs?.heart_rate"><span class="font-medium">HR:</span> {{ data?.objective?.vital_signs?.heart_rate }} bpm</p>
                    <p v-if="data?.objective?.vital_signs?.respiratory_rate"><span class="font-medium">RR:</span> {{ data?.objective?.vital_signs?.respiratory_rate }} rpm</p>
                    <p v-if="data?.objective?.vital_signs?.temperature"><span class="font-medium">Suhu:</span> {{ data?.objective?.vital_signs?.temperature }} °C</p>
                    <p v-if="data?.objective?.vital_signs?.weight || data?.objective?.vital_signs?.height">
                        <span class="font-medium">BB:</span> {{ data?.objective?.vital_signs?.weight || '-' }} kg,
                        <span class="font-medium">TB:</span> {{ data?.objective?.vital_signs?.height || '-' }} cm
                    </p>
                </div>
            </div>

            <Separator v-if="data?.subjective || data?.objective?.vital_signs" />

            <!-- Assessment Summary -->
            <div>
                <h4 class="mb-2 text-sm font-semibold text-muted-foreground uppercase tracking-wide">Assessment</h4>
                <div v-if="data?.assessment?.assessment_diagnoses?.length" class="space-y-2">
                    <p class="text-sm mb-2">{{ data?.assessment?.assessment_diagnoses?.length }} diagnosis tercatat:</p>
                    <Card v-for="dx in data?.assessment?.assessment_diagnoses" :key="dx.id">
                        <CardContent class="p-3 space-y-1 text-sm">
                            <p><span class="font-semibold">Kode ICD:</span> {{ dx.code }}</p>
                            <p><span class="font-semibold">Nama Diagnosis:</span> {{ dx.display }}</p>
                            <p><span class="font-semibold">Role:</span> {{ dx.diagnosis_role }}</p>
                            <p><span class="font-semibold">Status:</span> {{ dx.diagnosis_status }}</p>
                        </CardContent>
                    </Card>
                </div>
                <p class="text-sm text-muted-foreground" v-else>Belum ada diagnosis.</p>
            </div>

            <Separator />

            <!-- Plan Summary -->
            <div>
                <h4 class="mb-2 text-sm font-semibold text-muted-foreground uppercase tracking-wide">Plan</h4>

                <!-- Procedures -->
                <div v-if="data?.plan?.procedures?.length" class="mb-4">
                    <p class="text-sm font-medium mb-2">{{ data?.plan?.procedures?.length }} prosedur tercatat:</p>
                    <Card v-for="proc in data?.plan?.procedures" :key="proc.id" class="mb-2">
                        <CardContent class="p-3 space-y-1 text-sm">
                            <p><span class="font-semibold">Nama Prosedur:</span> {{ proc.name || proc.display }}</p>
                            <p v-if="proc.code"><span class="font-semibold">Kode ICD-9:</span> {{ proc.code }}</p>
                        </CardContent>
                    </Card>
                </div>
                <p v-else class="text-sm text-muted-foreground mb-4">Belum ada prosedur.</p>

                <!-- Medications -->
                <div v-if="data?.plan?.medications?.length">
                    <p class="text-sm font-medium mb-2">{{ data?.plan?.medications?.length }} obat diresepkan:</p>
                    <Card v-for="med in data?.plan?.medications" :key="med.id" class="mb-2">
                        <CardContent class="p-3 space-y-1 text-sm">
                            <p><span class="font-semibold">Nama Obat:</span> {{ med.name || '-' }}</p>
                            <p v-if="med.dose"><span class="font-semibold">Dosis:</span> {{ med.dose }}</p>
                            <p v-if="med.frequency_per_day"><span class="font-semibold">Frekuensi:</span> {{ med.frequency_per_day }}x per hari</p>
                            <p v-if="med.duration_days"><span class="font-semibold">Durasi:</span> {{ med.duration_days }} hari</p>
                            <p v-if="med.instruction"><span class="font-semibold">Aturan Pakai:</span> {{ mapInstruction(med.instruction) }}</p>
                            <p v-if="med.quantity"><span class="font-semibold">Jumlah:</span> {{ med.quantity }}</p>
                        </CardContent>
                    </Card>
                </div>
                <p v-else class="text-sm text-muted-foreground">Belum ada obat diresepkan.</p>
            </div>

            <Separator />

            <!-- Finish Button -->
            <div class="flex justify-end pt-2">
                <Button
                    v-if="data?.status !== 'finished'"
                    size="lg"
                    @click="finishEncounter"
                >
                    Selesai & Kembali ke Dashboard
                </Button>
                <div v-else class="text-sm text-muted-foreground">
                    Pemeriksaan telah selesai.
                </div>
            </div>
        </CardContent>
    </Card>
</template>
