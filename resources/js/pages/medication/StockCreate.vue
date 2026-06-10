<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import MedicationStockForm from '@/pages/medication/components/MedicationStockForm.vue';
import { Card, CardHeader, CardTitle, CardContent, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import LinkButton from '@/components/LinkButton.vue';
import { Head } from '@inertiajs/vue3';
import { index } from '@/routes/medication';
import { create } from '@/routes/medication/stock';
import { BreadcrumbItem } from '@/types';
import { Medication } from '@/types/resources/medication';
import { Pagination } from '@/types';
import { provide, toRef } from 'vue';

const props = defineProps<{
  medications: Pagination<Medication>
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Obat', href: index().url },
  { title: 'Tambah Stok Obat', href: create().url },
];

provide('medications', toRef(props, 'medications'));

const submitAll = () => {
  const formEl = document.getElementById('medication-stock-form') as HTMLFormElement | null;
  if (!formEl) return;
  if (typeof formEl.requestSubmit === 'function') formEl.requestSubmit();
  else formEl.submit();
};
</script>

<template>
  <Head title="Tambah Stok Obat" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-8 max-w-7xl mx-auto">
      <div class="flex items-center justify-between gap-4 mb-6">
        <div>
          <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Tambah Stok Obat</h1>
          <p class="mt-2 text-sm text-muted-foreground">Tambahkan stok baru ke inventaris. Form ini mendukung banyak entri sekaligus — gunakan tombol "Tambah baris" di formulir.</p>
        </div>

        <div class="flex items-center gap-3">
          <Button variant="default" size="sm" @click="submitAll">Simpan</Button>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
          <Card class="rounded-lg">
            <CardHeader class="px-6 pb-0 pt-6">
              <CardTitle class="text-lg">Form Tambah Stok</CardTitle>
              <CardDescription class="text-sm text-muted-foreground">Isi detail stok obat (nama, batch, kadaluarsa, jumlah, harga). Ringkasan per baris dan total tersedia di dalam formulir.</CardDescription>
            </CardHeader>

            <CardContent class="px-6 py-4">
              <MedicationStockForm />
            </CardContent>
          </Card>
        </div>

        <aside>
          <Card class="rounded-lg sticky top-6">
            <CardHeader class="px-6 pb-0 pt-6">
              <CardTitle class="text-lg">Ringkasan & Tips</CardTitle>
            </CardHeader>
            <CardContent class="px-6 py-4 space-y-3">
              <div class="text-sm text-muted-foreground">Ringkasan realtime ditampilkan di setiap baris formulir. Gunakan tombol Simpan untuk mengirim semua entri sekaligus.</div>

              <details class="text-sm">
                <summary class="cursor-pointer font-medium">Tips cepat</summary>
                <ul class="mt-2 list-disc pl-5 text-sm text-muted-foreground space-y-1">
                  <li>Gunakan pencarian untuk memilih obat yang tepat.</li>
                  <li>Isi tanggal kadaluarsa agar sistem bisa mengingatkan.</li>
                  <li>Periksa harga beli dan harga jual sebelum menyimpan.</li>
                </ul>
              </details>

              <div class="pt-3 border-t">
                <div class="mb-2 text-sm text-muted-foreground">Aksi cepat</div>
                <div class="flex flex-col gap-2">
                  <LinkButton :href="index().url" label="Lihat daftar obat" variant="ghost" />
                </div>
              </div>
            </CardContent>
          </Card>
        </aside>
      </div>
    </div>
  </AppLayout>
</template>
