<script setup lang="ts">
import type { DateValue } from '@internationalized/date'
import { getLocalTimeZone, today } from '@internationalized/date'
import { ChevronDownIcon } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Calendar } from '@/components/ui/calendar'
import { Label } from '@/components/ui/label'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'
import { ref, Ref } from 'vue'

defineProps<{
    label?: string
}>()

const date = ref(today(getLocalTimeZone())) as Ref<DateValue>

const emit = defineEmits<{
    (e: 'selected', val: DateValue): void
}>()

const defaultPlaceholder = today(getLocalTimeZone())
</script>

<template>
  <div class="flex flex-col gap-3">
    <Label for="date" class="px-1" v-if="label">
      {{label}}
    </Label>
    <Popover v-slot="{ close }">
      <PopoverTrigger as-child>
        <Button
          id="date"
          variant="outline"
          class="justify-between font-normal bg-input border-border border"
        >
          {{ date ? date.toDate(getLocalTimeZone()).toLocaleDateString() : "Select date" }}
          <ChevronDownIcon />
        </Button>
      </PopoverTrigger>
      <PopoverContent class="w-auto overflow-hidden p-0" align="start">
        <Calendar
          :model-value="date"
          layout="month-and-year"
          :default-placeholder="defaultPlaceholder"
          disable-days-outside-current-view
          @update:model-value="(value) => {
            if (value) {
              date = value
              emit('selected', date)
              close()
            }
          }"
        />
      </PopoverContent>
    </Popover>
  </div>
</template>
