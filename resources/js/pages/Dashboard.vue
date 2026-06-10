<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import {
    Users,
    UserCheck,
    Package,
    AlertTriangle,
    CheckCircle2,
    Stethoscope,
} from 'lucide-vue-next';
import { index as encounterIndex, store as encounterStore } from '@/actions/App/Http/Controllers/Resources/EncounterController';

interface PatientToday {
    id: number;
    queue_number: number;
    patient_name: string;
    patient_id: number;
    practitioner_user_id: number | null;
    encounter_uuid: string | null;
    status: string;
}

interface LowStockMedication {
    id: number;
    generic_name: string;
    trade_name: string;
    total_quantity: number;
    unit: string;
}

interface QueueStatusCounts {
    [key: string]: number;
}

defineProps<{
    patientsToday: PatientToday[];
    patientsTodayCount: number;
    lowStockMedications: LowStockMedication[];
    totalPatients: number;
    queueStatusCounts: QueueStatusCounts;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const statusLabels: Record<string, string> = {
    planned: 'Direncanakan',
    'in-progress': 'Dalam Antrian',
    finished: 'Selesai',
    cancelled: 'Dibatalkan',
};

const statusBadgeVariant = (status: string): 'default' | 'secondary' | 'destructive' | 'outline' => {
    switch (status) {
        case 'planned': return 'secondary';
        case 'in-progress': return 'default';
        case 'finished': return 'outline';
        case 'cancelled': return 'destructive';
        default: return 'secondary';
    }
};

const stockBadgeVariant = (qty: number): 'destructive' | 'default' | 'outline' => {
    if (qty <= 3) return 'destructive';
    if (qty <= 6) return 'default';
    return 'outline';
};

const openRekamMedis = (patient: PatientToday) => {
    if (patient.status === 'planned') {
        router.post(encounterStore().url, {
            patient_id: patient.patient_id,
            practitioner_id: patient.practitioner_user_id,
            queue_id: patient.id,
        });
    } else if (patient.status === 'in-progress' && patient.encounter_uuid) {
        router.get(encounterIndex({ encounter: patient.encounter_uuid }).url);
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <!-- Stat Cards -->
            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between pb-2">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Pasien Hari Ini
                        </CardTitle>
                        <UserCheck class="h-5 w-5 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-3xl font-bold">{{ patientsTodayCount }}</div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader class="flex flex-row items-center justify-between pb-2">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Total Pasien Terdaftar
                        </CardTitle>
                        <Users class="h-5 w-5 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-3xl font-bold">{{ totalPatients }}</div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader class="flex flex-row items-center justify-between pb-2">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Stok Obat Menipis
                        </CardTitle>
                        <Package class="h-5 w-5 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-3xl font-bold">{{ lowStockMedications.length }}</div>
                    </CardContent>
                </Card>
            </div>

            <!-- Queue Status Summary -->
            <!-- <div v-if="Object.keys(queueStatusCounts).length" class="grid gap-4 md:grid-cols-4">
                <Card v-for="(count, status) in queueStatusCounts" :key="status">
                    <CardHeader class="flex flex-row items-center justify-between pb-2">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            {{ statusLabels[status] || status }}
                        </CardTitle>
                        <ClipboardList v-if="status === 'planned'" class="h-5 w-5 text-muted-foreground" />
                        <Clock v-else-if="status === 'in-progress'" class="h-5 w-5 text-muted-foreground" />
                        <CheckCircle2 v-else-if="status === 'finished'" class="h-5 w-5 text-muted-foreground" />
                        <XCircle v-else class="h-5 w-5 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ count }}</div>
                    </CardContent>
                </Card>
            </div> -->

            <!-- Main Content: Two Columns -->
            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Patients Today List -->
                <Card>
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <UserCheck class="h-5 w-5" />
                            Daftar Pasien Hari Ini
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div v-if="patientsToday.length > 0">
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead class="w-20">No. Antri</TableHead>
                                        <TableHead>Nama Pasien</TableHead>
                                        <TableHead>Status</TableHead>
                                        <TableHead class="text-right">Aksi</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    <TableRow v-for="patient in patientsToday" :key="patient.queue_number">
                                        <TableCell class="font-medium">#{{ patient.queue_number }}</TableCell>
                                        <TableCell>{{ patient.patient_name }}</TableCell>
                                        <TableCell>
                                            <Badge :variant="statusBadgeVariant(patient.status)">
                                                {{ statusLabels[patient.status] || patient.status }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="text-right">
                                            <Button
                                                v-if="patient.status === 'planned' || (patient.status === 'in-progress' && patient.encounter_uuid)"
                                                variant="outline"
                                                size="sm"
                                                @click="openRekamMedis(patient)"
                                            >
                                                <Stethoscope class="mr-1 h-4 w-4" />
                                                Rekam Medis
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </div>
                        <div v-else class="flex flex-col items-center justify-center py-10 text-center text-muted-foreground">
                            <UserCheck class="mb-2 h-8 w-8" />
                            <p>Tidak ada pasien hari ini.</p>
                        </div>
                    </CardContent>
                </Card>

                <!-- Low Stock Medications -->
                <Card>
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <AlertTriangle class="h-5 w-5 text-destructive" />
                            Stok Obat Menipis
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div v-if="lowStockMedications.length > 0">
                                <Table>
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead>Nama Obat</TableHead>
                                            <TableHead class="text-right">Total Stok</TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody v-for="med in lowStockMedications" :key="med.id">
                                        <TableRow>
                                            <TableCell>
                                                <div class="font-medium">{{ med.trade_name || med.generic_name }}</div>
                                                <div class="text-xs text-muted-foreground">{{ med.generic_name }}</div>
                                            </TableCell>
                                            <TableCell class="text-right">
                                                <Badge :variant="stockBadgeVariant(med.total_quantity)">
                                                    {{ med.total_quantity }} {{ med.unit }}
                                                </Badge>
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                </Table>
                        </div>
                        <div v-else class="flex flex-col items-center justify-center py-10 text-center text-muted-foreground">
                            <CheckCircle2 class="mb-2 h-8 w-8 text-green-500" />
                            <p>Semua stok obat aman.</p>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
