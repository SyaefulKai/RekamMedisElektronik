<script setup lang="ts">
import { show } from '@/actions/App/Http/Controllers/Resources/EncounterController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Encounter } from '@/types/resources/encounter';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    encounter: Encounter;
}>();

const encounter = computed(() => props.encounter);

const statusLabel: Record<string, string> = {
    'arrived': 'Tiba',
    'in-progress': 'Sedang Diperiksa',
    'finished': 'Selesai',
    'cancelled': 'Dibatalkan',
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Riwayat Rekam Medis',
        href: '#',
    },
    {
        title: `Kunjungan - ${encounter.value.patient?.name ?? ''}`,
        href: show({
            encounter: encounter.value.uuid,
        }).url,
    },
];
</script>

<template>
    <Head :title="`Rekam Medis - ${encounter.patient?.name ?? ''}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-8">
            <!-- Header -->
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <h1 class="scroll-m-20 text-balance text-3xl font-extrabold tracking-tight">
                    Detail Rekam Medis
                </h1>
                <span
                    class="inline-flex w-fit items-center rounded-md px-2.5 py-1 text-xs font-medium"
                    :class="{
                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300': encounter.status === 'arrived',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': encounter.status === 'in-progress',
                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': encounter.status === 'finished',
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': encounter.status === 'cancelled',
                    }"
                >
                    {{ statusLabel[encounter.status] ?? encounter.status }}
                </span>
            </div>

            <!-- Patient & Visit Info -->
            <div class="grid gap-4 border rounded-md p-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">No. Rekam Medis</span>
                    <span class="font-medium">{{ encounter.patient?.medical_record_number }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Nama Pasien</span>
                    <span class="font-medium">{{ encounter.patient?.name }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Dokter</span>
                    <span class="font-medium">{{ encounter.practitioner?.user?.name ?? '-' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-muted-foreground">Tanggal Kunjungan</span>
                    <span class="font-medium">{{ new Date(encounter.date).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) }}</span>
                </div>
            </div>

            <!-- Subjective -->
            <div class="rounded-md border p-4">
                <h2 class="mb-4 text-lg font-semibold">Subjektif</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-muted-foreground">Keluhan Utama</span>
                        <p class="text-sm">{{ encounter.subjective?.chief_complaint || '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-muted-foreground">Detail Keluhan</span>
                        <p class="text-sm">{{ encounter.subjective?.history_of_present_illness || '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-muted-foreground">Riwayat Medis</span>
                        <p class="text-sm">{{ encounter.subjective?.past_medical_history || '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-muted-foreground">Riwayat Medis Keluarga</span>
                        <p class="text-sm">{{ encounter.subjective?.family_medical_history || '-' }}</p>
                    </div>
                </div>
                <!-- Allergies -->
                <div v-if="encounter.subjective?.allergies?.length" class="mt-4">
                    <span class="text-sm text-muted-foreground">Alergi</span>
                    <div class="mt-1 flex flex-wrap gap-2">
                        <span
                            v-for="(allergy, idx) in encounter.subjective.allergies"
                            :key="idx"
                            class="inline-flex items-center rounded-md border border-border bg-muted px-2.5 py-1 text-xs font-medium"
                        >
                            {{ allergy.name }}
                            <span v-if="allergy.severity" class="ml-1 text-muted-foreground">({{ allergy.severity }})</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Objective -->
            <div class="rounded-md border p-4">
                <h2 class="mb-4 text-lg font-semibold">Objektif</h2>
                <!-- Vital Signs -->
                <div v-if="encounter.objective?.vital_signs" class="mb-4">
                    <h3 class="mb-2 text-sm font-medium text-muted-foreground">Tanda Vital</h3>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        <div v-if="encounter.objective.vital_signs.systolic" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Tekanan Darah</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.systolic }}/{{ encounter.objective.vital_signs.diastolic }} mmHg</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.heart_rate" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Detak Jantung</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.heart_rate }} bpm</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.respiratory_rate" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Pernafasan</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.respiratory_rate }} /menit</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.temperature" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Suhu</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.temperature }}°C</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.oxygen_saturation" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Saturasi Oksigen</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.oxygen_saturation }}%</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.weight" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Berat Badan</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.weight }} kg</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.height" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">Tinggi Badan</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.height }} cm</span>
                        </div>
                        <div v-if="encounter.objective.vital_signs.bmi" class="flex flex-col rounded-md border p-3">
                            <span class="text-xs text-muted-foreground">BMI</span>
                            <span class="text-sm font-medium">{{ encounter.objective.vital_signs.bmi }}</span>
                        </div>
                    </div>
                </div>
                <!-- Physical Examination -->
                <div v-if="encounter.objective?.physical_examination" class="flex flex-col gap-1">
                    <span class="text-sm text-muted-foreground">Pemeriksaan Fisik</span>
                    <p class="text-sm">{{ encounter.objective.physical_examination }}</p>
                </div>
            </div>

            <!-- Assessment -->
            <div class="rounded-md border p-4">
                <h2 class="mb-4 text-lg font-semibold">Asesmen</h2>
                <div v-if="encounter.assessment?.assessment_diagnoses?.length">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b text-left text-muted-foreground">
                                <th class="pb-2 font-medium">No</th>
                                <th class="pb-2 font-medium">Kode</th>
                                <th class="pb-2 font-medium">Deskripsi</th>
                                <th class="pb-2 font-medium">Peran</th>
                                <th class="pb-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(diagnosis, idx) in encounter.assessment.assessment_diagnoses" :key="diagnosis.id" class="border-b last:border-0">
                                <td class="py-2">{{ idx + 1 }}</td>
                                <td class="py-2 font-medium">{{ diagnosis.code }}</td>
                                <td class="py-2">{{ diagnosis.display }}</td>
                                <td class="py-2">{{ diagnosis.diagnosis_role }}</td>
                                <td class="py-2">{{ diagnosis.diagnosis_status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p v-else class="text-sm text-muted-foreground">Tidak ada data diagnosis.</p>
            </div>

            <!-- Plan -->
            <div class="rounded-md border p-4">
                <h2 class="mb-4 text-lg font-semibold">Rencana</h2>
                <!-- Procedures -->
                <div v-if="encounter.plan?.procedures?.length" class="mb-4">
                    <h3 class="mb-2 text-sm font-medium text-muted-foreground">Tindakan</h3>
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b text-left text-muted-foreground">
                                <th class="pb-2 font-medium">No</th>
                                <th class="pb-2 font-medium">Kode</th>
                                <th class="pb-2 font-medium">Nama</th>
                                <th class="pb-2 font-medium">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(proc, idx) in encounter.plan.procedures" :key="idx" class="border-b last:border-0">
                                <td class="py-2">{{ idx + 1 }}</td>
                                <td class="py-2 font-medium">{{ proc.code }}</td>
                                <td class="py-2">{{ proc.name }}</td>
                                <td class="py-2">{{ proc.display }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="mb-4">
                    <h3 class="mb-2 text-sm font-medium text-muted-foreground">Tindakan</h3>
                    <p class="text-sm text-muted-foreground">Tidak ada data tindakan.</p>
                </div>
                <!-- Medications -->
                <div v-if="encounter.plan?.medications?.length">
                    <h3 class="mb-2 text-sm font-medium text-muted-foreground">Obat</h3>
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b text-left text-muted-foreground">
                                <th class="pb-2 font-medium">No</th>
                                <th class="pb-2 font-medium">Nama Obat</th>
                                <th class="pb-2 font-medium">Dosis</th>
                                <th class="pb-2 font-medium">Frekuensi/Hari</th>
                                <th class="pb-2 font-medium">Jumlah</th>
                                <th class="pb-2 font-medium">Instruksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(med, idx) in encounter.plan.medications" :key="med.id" class="border-b last:border-0">
                                <td class="py-2">{{ idx + 1 }}</td>
                                <td class="py-2 font-medium">{{ med.name }}</td>
                                <td class="py-2">{{ med.dose_per_take ?? '-' }}</td>
                                <td class="py-2">{{ med.frequency_per_day ?? '-' }}</td>
                                <td class="py-2">{{ med.quantity }}</td>
                                <td class="py-2">{{ med.instruction || '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <h3 class="mb-2 text-sm font-medium text-muted-foreground">Obat</h3>
                    <p class="text-sm text-muted-foreground">Tidak ada data obat.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
