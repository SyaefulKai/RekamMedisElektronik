<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { SharedData, User } from '@/types';
import { usePage } from '@inertiajs/vue3';

const page = usePage<SharedData>()

defineProps<{
    onEdit: (user: User) => void
}>()

</script>

<template>
    <Button variant="secondary" size="sm" v-if="page.props.auth.permissions.includes('update.user')" @click="onEdit">
        Edit
    </Button>
</template>
