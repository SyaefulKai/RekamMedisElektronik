<script setup lang="ts">
import { index } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: index().url
    }
]

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        
    </AppLayout>
</template>
