<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Activity, ClipboardList, FileText, Heart, Shield, Users } from 'lucide-vue-next';
</script>

<template>
    <Head title="Rekam Medis Elektronik">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col bg-background text-foreground">
        <!-- Navigation -->
        <header class="sticky top-0 z-50 border-b border-border bg-background/80 backdrop-blur-md">
            <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-2">
                    <Heart class="h-5 w-5 text-primary" :stroke-width="2.5" />
                    <span class="text-lg font-bold tracking-tight">Rekam Medis Elektronik</span>
                </div>
                <div class="flex items-center gap-3">
                    <Link
                        v-if="$page.props.auth.user.name != null"
                        :href="route('dashboard')"
                        class="inline-flex items-center rounded-md bg-primary px-5 py-2 text-sm font-medium text-primary-foreground shadow-sm transition-colors hover:bg-primary/90"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-flex items-center rounded-md px-4 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                        >
                            Masuk
                        </Link>
                        <!-- <Link
                            :href="route('register')"
                            class="inline-flex items-center rounded-md bg-primary px-5 py-2 text-sm font-medium text-primary-foreground shadow-sm transition-colors hover:bg-primary/90"
                        >
                            Daftar
                        </Link> -->
                    </template>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-muted/50 to-background" />
            <div class="relative mx-auto max-w-6xl px-6 py-24 lg:py-32">
                <div class="flex flex-col items-center text-center">
                    <div class="mb-6 inline-flex items-center rounded-full border border-border bg-muted px-4 py-1.5 text-sm font-medium text-muted-foreground">
                        <Activity class="mr-1.5 h-3.5 w-3.5" />
                        Sistem Informasi Kesehatan
                    </div>
                    <h1 class="mb-6 max-w-3xl text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                        Kelola Rekam Medis Pasien dengan
                        <span class="text-primary">Mudah & Terintegrasi</span>
                    </h1>
                    <p class="mb-10 max-w-2xl text-lg text-muted-foreground">
                        Platform digital untuk pencatatan dan pengelolaan data rekam medis pasien secara komprehensif.
                        Mulai dari pendaftaran, antrian, hingga dokumentasi klinis SOAP dalam satu sistem.
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <Link
                            :href="route('login')"
                            class="inline-flex items-center justify-center rounded-md bg-primary px-8 py-3 text-sm font-semibold text-primary-foreground shadow-md transition-all hover:bg-primary/90 hover:shadow-lg"
                        >
                            Masuk ke Sistem
                        </Link>
                        <a
                            href="#fitur"
                            class="inline-flex items-center justify-center rounded-md border border-border bg-background px-8 py-3 text-sm font-semibold text-foreground shadow-sm transition-all hover:bg-accent hover:text-accent-foreground"
                        >
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="fitur" class="border-t border-border bg-muted/30 py-20">
            <div class="mx-auto max-w-6xl px-6">
                <div class="mb-14 text-center">
                    <h2 class="mb-3 text-3xl font-bold tracking-tight sm:text-4xl">Fitur Utama</h2>
                    <p class="mx-auto max-w-xl text-muted-foreground">
                        Solusi lengkap untuk kebutuhan pencatatan medis di fasilitas kesehatan Anda.
                    </p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <Users class="h-5 w-5 text-muted-foreground" />
                        </div>
                        <h3 class="mb-2 font-semibold">Manajemen Pasien</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Pendaftaran dan pengelolaan data pasien lengkap dengan nomor induk kependudukan dan nomor rekam medis.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <ClipboardList class="h-5 w-5 text-muted-foreground" />
                        </div>
                        <h3 class="mb-2 font-semibold">Sistem Antrian</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Pengelolaan antrian pasien secara digital dengan pemilihan dokter praktik dan pemantauan status secara real-time.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <FileText class="h-5 w-5 text-muted-foreground" />
                        </div>
                        <h3 class="mb-2 font-semibold">Rekam Medis SOAP</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Dokumentasi klinis lengkap menggunakan format SOAP — Subjektif, Objektif, Asesmen, dan Rencana Perawatan.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <svg class="h-5 w-5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-semibold">Diagnosis & Kode ICD</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Pencarian dan pencatatan kode diagnosis ICD-10 untuk asesmen klinis yang akurat dan terstandarisasi.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <svg class="h-5 w-5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-semibold">Riwayat Medis</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Akses riwayat kunjungan dan rekam medis pasien sebelumnya untuk kontinuitas perawatan yang lebih baik.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-md bg-muted">
                            <Shield class="h-5 w-5 text-muted-foreground" />
                        </div>
                        <h3 class="mb-2 font-semibold">Keamanan Data</h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            Sistem autentikasi dan otorisasi berbasis peran untuk melindungi data pasien sesuai standar keamanan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-border bg-background py-8">
            <div class="mx-auto max-w-6xl px-6 text-center">
                <div class="mb-3 flex items-center justify-center gap-2">
                    <Heart class="h-4 w-4 text-primary" :stroke-width="2.5" />
                    <span class="text-sm font-semibold">Rekam Medis Elektronik</span>
                </div>
                <p class="text-xs text-muted-foreground">
                    &copy; {{ new Date().getFullYear() }} Rekam Medis Elektronik. Hak cipta dilindungi.
                </p>
            </div>
        </footer>
    </div>
</template>
