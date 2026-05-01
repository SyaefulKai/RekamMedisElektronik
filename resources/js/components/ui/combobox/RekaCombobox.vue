<script setup lang="ts">
import {
  ComboboxAnchor,
  ComboboxContent,
  ComboboxEmpty,
  ComboboxGroup,
  ComboboxInput,
  ComboboxItem,
  ComboboxItemIndicator,
  ComboboxPortal,
  ComboboxRoot,
  ComboboxTrigger,
  ComboboxViewport,
} from 'reka-ui'
import { Check, ChevronsUpDown } from 'lucide-vue-next'
import { ref, computed } from 'vue'
import { cn } from '@/lib/utils'
import { ComboboxItem as ComboboxItemType } from '@/components/ui/combobox'

const props = withDefaults(defineProps<{
  items: ComboboxItemType[]
  placeholder?: string
  modelValue?: string
  serverSearch?: boolean
}>(), {
  placeholder: 'Pilih...',
  serverSearch: false,
})

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
  (e: 'search', value: string): void
}>()

const searchTerm = ref('')
const open = ref(false)

const selectedLabel = computed(() =>
  props.items.find(i => i.value === props.modelValue)?.label ?? ''
)

const internalValue = computed(() =>
  props.items.find(i => i.value === props.modelValue) ?? null
)

function onUpdateModelValue(val: ComboboxItemType | null) {
  if (val) {
    emit('update:modelValue', val.value)
    // searchTerm.value = ''
    open.value = false
  }
}

function onOpenChange(val: boolean) {
  open.value = val
//   if (!val) searchTerm.value = ''
}
</script>

<template>
  <ComboboxRoot
    :model-value="internalValue"
    :filter-function="serverSearch ? (() => true) : undefined"
    :open="open"
    @update:model-value="onUpdateModelValue"
    @update:open="onOpenChange"
  >
    <ComboboxAnchor class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-within:ring-2 focus-within:ring-ring focus-within:ring-offset-2">
    <ComboboxInput
        v-model="searchTerm"
        class="flex-1 bg-transparent outline-none placeholder:text-muted-foreground"
        :placeholder="placeholder"
        :display-value="(item: any) => item?.label ?? selectedLabel"
        @input="emit('search', ($event.target as HTMLInputElement).value)"
    />
      <ComboboxTrigger class="ml-2 shrink-0 opacity-50 hover:opacity-100">
        <ChevronsUpDown class="h-4 w-4" />
      </ComboboxTrigger>
    </ComboboxAnchor>

    <ComboboxPortal>
      <ComboboxContent
        position="popper"
        :side-offset="4"
        class="z-50 w-[--reka-combobox-trigger-width] overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-md data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95"
      >
        <ComboboxViewport class="max-h-60 overflow-y-auto p-1">
          <ComboboxEmpty class="py-6 text-center text-sm text-muted-foreground">
            Tidak ada hasil.
          </ComboboxEmpty>
          <ComboboxGroup>
            <ComboboxItem
              v-for="item in items"
              :key="item.value"
              :value="item"
              class="relative flex cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none data-[highlighted]:bg-accent data-[highlighted]:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            >
              <ComboboxItemIndicator class="absolute left-2 flex h-4 w-4 items-center justify-center">
                <Check class="h-4 w-4" />
              </ComboboxItemIndicator>
              {{ item.label }}
            </ComboboxItem>
          </ComboboxGroup>
        </ComboboxViewport>
      </ComboboxContent>
    </ComboboxPortal>
  </ComboboxRoot>
</template>
