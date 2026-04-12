<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { SharedData, User } from '@/types';
import { usePage } from '@inertiajs/vue3';

defineProps<{
    user: User
}>()

const page = usePage<SharedData>()

const emit = defineEmits<{
    (e: 'delete', val: User): void
}>()
</script>

<template>
    <Button variant="destructive" size="sm" @click="() => emit('delete', user)" v-if="page.props.auth.permissions.includes('delete.user')">
        Hapus
    </Button>
</template>
