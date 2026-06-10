
<script setup lang="ts">
import { RekaCombobox } from '@/components/ui/combobox'
import type { ComboboxItem } from '@/components/ui/combobox'
import { inject } from 'vue';

defineProps<{
  items: ComboboxItem[]
  modelValue?: string
  placeholder?: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const search = inject<(query: Record<string, any>) => void>('searchCode', () => {})
</script>

<template>
  <RekaCombobox
    :items="items"
    :placeholder="placeholder || 'Pilih ICD-9'"
    :model-value="modelValue"
    @update:modelValue="val => emit('update:modelValue', val)"
    @search="(val) => search({
        query: val
    })"
  />
</template>
