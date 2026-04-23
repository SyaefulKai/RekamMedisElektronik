<script setup lang="ts">
import { Button, ButtonVariants } from '@/components/ui/button';
import { HttpMethod } from '@/types';
import { Link } from '@inertiajs/vue3';
import { FunctionalComponent } from 'vue';

defineProps<{
    variant?: ButtonVariants['variant'],
    href: string,
    label: string
    method?: HttpMethod,
    icon?: FunctionalComponent
    data?: any
}>()

</script>

<template>
<Button as-child :variant="variant ?? 'default'" :class="$attrs.class">
    <Link :href="href" :method="method ?? 'get'" :data="data">
        <component v-if="icon" :is="icon"/>
        {{ label }}
    </Link>
</Button>
</template>
