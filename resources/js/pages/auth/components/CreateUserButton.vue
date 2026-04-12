<script setup lang="ts">
import { create } from '@/actions/App/Http/Controllers/Auth/UserController';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <Button as-child>
        <Link :href="create().url">
            Tambah Pengguna
        </Link>
    </Button>
</template>
