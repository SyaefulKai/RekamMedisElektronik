<script setup lang="ts">
import { update } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import { Button } from '@/components/ui/button';
import { Role } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    role: Role;
    permissions: string[];
}>();
</script>

<template>
    <Button as-child>
        <Link
            method="patch"
            :href="update({
                role: role.id,
            })"
            :data="{
                role: role.id,
                permissions: permissions,
            }"
        >
            Simpan
        </Link>
    </Button>
</template>
