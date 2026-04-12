<script setup lang="ts">
import { create } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <Button as-child>
        <Link
        :href="create().url">
            Tambah Role
        </Link>
    </Button>
</template>
