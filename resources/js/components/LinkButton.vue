<script setup lang="ts">
import { Button, ButtonVariants } from '@/components/ui/button';
import { HttpMethod } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    variant?: ButtonVariants['variant'],
    href: string,
    label: string
    method?: HttpMethod
}>()

</script>

<template>
<Button as-child :variant="variant ?? 'default'">
    <Link :href="href" :method="method ?? 'get'">
        {{ label }}
    </Link>
</Button>
</template>
