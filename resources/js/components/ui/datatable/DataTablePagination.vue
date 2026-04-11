<script setup lang="ts">
import {
  Pagination,
  PaginationContent,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'
import { type Table } from '@tanstack/vue-table';

const props = defineProps<{
    table: Table<any>,
    loading?: boolean
}>()
</script>

<template>
  <div class="flex flex-col gap-6">
    <Pagination v-slot="{ page }" :items-per-page="table.getState().pagination.pageSize" :total="table.getRowCount()" :default-page="table.getState().pagination.pageIndex + 1">
      <PaginationContent v-slot="{ items }">
        <PaginationPrevious @click="table.previousPage()" :disabled="loading"/>
        <template v-for="(item, index) in items" :key="index">
          <PaginationItem
            v-if="item.type === 'page'"
            :value="item.value"
            :is-active="item.value === page"
            @click="table.setPageIndex(item.value - 1)"
            :disabled="loading"
          >
            {{ item.value }}
          </PaginationItem>
        </template>

        <PaginationNext @click="table.nextPage()" :disabled="loading"/>
      </PaginationContent>
    </Pagination>
  </div>
</template>
