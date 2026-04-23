<script setup lang="ts">
import { Input } from '@/components/ui/input';
const emit = defineEmits<{
    (e: 'input', val: string): void
}>()
</script>

<template>
<Input class="md:w-[15%]" placeholder="Cari" @input="(event: Event) => emit('input', (event.target as HTMLInputElement).value)"/>
</template>
