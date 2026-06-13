<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import { FileText, Loader2 } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Laporan',
        href: route('report.index'),
    },
];

const startDate = ref<string>('');
const endDate = ref<string>('');
const isLoading = ref<boolean>(false);

const generateReport = () => {
    if (!startDate.value || !endDate.value) {
        toast.error('Silakan pilih periode tanggal terlebih dahulu');
        return;
    }

    if (startDate.value > endDate.value) {
        toast.error('Tanggal awal tidak boleh lebih dari tanggal akhir');
        return;
    }

    isLoading.value = true;

    const url = route('report.pdf', {
        start_date: startDate.value,
        end_date: endDate.value,
    });

    // Use window.location to trigger PDF file download
    window.location.href = url;

    // Reset loading state after a short delay
    setTimeout(() => {
        isLoading.value = false;
    }, 2000);
};

const formatDateForInput = (date: Date): string => {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
};

// Set default date range to current month
const today = new Date();
const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
startDate.value = formatDateForInput(firstDayOfMonth);
endDate.value = formatDateForInput(today);
</script>

<template>
    <Head title="Laporan Kunjungan Pasien" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-8">
            <div class="flex flex-col gap-2">
                <h1 class="scroll-m-20 text-balance text-4xl font-extrabold tracking-tight">
                    Laporan Kunjungan Pasien
                </h1>
                <p class="text-muted-foreground text-sm">
                    Cetak laporan data kunjungan pasien berdasarkan periode tanggal
                </p>
            </div>

            <div class="bg-card text-card-foreground rounded-xl border p-6 shadow-sm">
                <div class="flex flex-col gap-6">
                    <h3 class="text-lg font-semibold">Filter Periode</h3>
                    <div class="flex flex-wrap items-end gap-4">
                        <div class="flex flex-col gap-2">
                            <label for="start_date" class="text-sm font-medium">Tanggal Awal</label>
                            <input
                                id="start_date"
                                v-model="startDate"
                                type="date"
                                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-56 rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="end_date" class="text-sm font-medium">Tanggal Akhir</label>
                            <input
                                id="end_date"
                                v-model="endDate"
                                type="date"
                                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-56 rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            />
                        </div>
                        <button
                            @click="generateReport"
                            :disabled="isLoading"
                            class="bg-primary text-primary-foreground hover:bg-primary/90 focus-visible:ring-ring inline-flex h-10 items-center justify-center gap-2 rounded-md px-6 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                        >
                            <Loader2 v-if="isLoading" class="h-4 w-4 animate-spin" />
                            <FileText v-else class="h-4 w-4" />
                            <span>{{ isLoading ? 'Memproses...' : 'Cetak Laporan PDF' }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-card text-card-foreground rounded-xl border p-6 shadow-sm">
                <h3 class="mb-3 text-lg font-semibold">Informasi</h3>
                <ul class="text-muted-foreground list-disc space-y-1 pl-5 text-sm">
                    <li>Laporan akan mencakup seluruh data kunjungan pasien pada periode yang dipilih.</li>
                    <li>Setiap kunjungan menampilkan: tanggal, nomor RM, nama pasien, keluhan, diagnosa, dan praktisi.</li>
                    <li>File PDF akan diunduh secara otomatis setelah proses selesai.</li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
