<script setup lang="ts">
import { Button, ButtonVariants } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineProps<{
    variant?: ButtonVariants['variant'],
    href: string,
    label: string
}>()

</script>

<template>
<Button as-child :variant="variant ?? 'default'">
    <Link :href="href">
        {{ label }}
    </Link>
</Button>
</template>
