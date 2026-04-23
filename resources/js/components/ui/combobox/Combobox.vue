<script setup lang="ts">
import { CheckIcon, ChevronsUpDownIcon } from 'lucide-vue-next'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
} from '@/components/ui/command'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'
import { cn } from '@/lib/utils'
import { ComboboxItem } from '@/components/ui/combobox'

defineProps<{
    items: ComboboxItem[],
    placeholder?: string
}>()

const emit = defineEmits<{
    (e: 'item:select', val: string): void
    (e: 'input:search', val: string): void
}>()

const open = ref(false)
const value = ref('')

const search = (val: Event) => {
    emit('input:search', (val.target as HTMLSelectElement).value)
}
</script>

<template>
  <Popover v-model:open="open">
    <PopoverTrigger as-child>
      <Button
        variant="outline"
        role="combobox"
        :aria-expanded="open"
        class="w-[200px] justify-between"
      >
        {{
          value
            ? items.find(item => item.value === value)?.label
            : placeholder ?? 'Placeholder'
        }}
        <ChevronsUpDownIcon class="ml-2 h-4 w-4 shrink-0 opacity-50" />
      </Button>
    </PopoverTrigger>
    <PopoverContent class="w-[200px] p-0">
      <Command>
        <CommandInput :placeholder="placeholder ?? 'Placeholder'" @input="search"/>
        <CommandList>
          <CommandEmpty>Kosong</CommandEmpty>
          <CommandGroup>
            <CommandItem
              v-for="item in items"
              :key="item.value"
              :value="item.value"
              @select="() => {
                value = value === item.value ? '' : item.value
                open = false
                emit('item:select', value)
              }"
            >
              <CheckIcon
                :class="cn(
                  'mr-2 h-4 w-4',
                  value === item.value ? 'opacity-100' : 'opacity-0',
                )"
              />
              {{ item.label }}
            </CommandItem>
          </CommandGroup>
        </CommandList>
      </Command>
    </PopoverContent>
  </Popover>
</template>
