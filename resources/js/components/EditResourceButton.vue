<script setup lang="ts">
import { Button, ButtonVariants } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineProps<{
    path: string,
    variant?: ButtonVariants['variant']
}>()

</script>

<template>
    <Button as-child :variant="variant ?? 'secondary'">
        <Link :href="path">
            Edit
        </Link>
    </Button>
</template>
