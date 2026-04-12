<script setup lang="ts" generic="TData, TValue">
import type { ColumnDef } from '@tanstack/vue-table'
import {
  FlexRender,
  getCoreRowModel,
  useVueTable,
} from '@tanstack/vue-table'

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Pagination } from '@/types';
import { router } from '@inertiajs/vue3';
import DataTablePagination from '@/components/ui/datatable/DataTablePagination.vue';
import { ref } from 'vue';

const props = defineProps<{
  columns: ColumnDef<TData, TValue>[]
  pagination: Pagination<TData>
}>()

const loading = ref(false)

const table = useVueTable({
  get data() {
    return props.pagination.data
  },
  get columns() {
    return props.columns
  },
  getCoreRowModel: getCoreRowModel(),
  manualPagination: true,
  rowCount: props.pagination.total,
  state: {
    pagination: {
      pageIndex: props.pagination.current_page - 1,
      pageSize: props.pagination.per_page,
    },
  },
  onPaginationChange: (updater) => {
      const next =
    typeof updater === 'function'
      ? updater(table.getState().pagination)
      : updater

    router.get(props.pagination.path, {
        page: next.pageIndex + 1,
    }, {
        onStart: () => loading.value = true,
        onFinish: () => loading.value = false
    })
  }
})
</script>

<template>
  <div class="border rounded-md">
    <Table>
      <TableHeader>
        <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
          <TableHead v-for="header in headerGroup.headers" :key="header.id">
            <FlexRender
              v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
              :props="header.getContext()"
            />
          </TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <template v-if="table.getRowModel().rows?.length">
          <TableRow
            v-for="row in table.getRowModel().rows" :key="row.id"
            :data-state="row.getIsSelected() ? 'selected' : undefined"
          >
            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
              <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
            </TableCell>
          </TableRow>
        </template>
        <template v-else>
          <TableRow>
            <TableCell :colspan="columns.length" class="h-24 text-center">
              No results.
            </TableCell>
          </TableRow>
        </template>
      </TableBody>
    </Table>
</div>
<div class="mt-4">
    <DataTablePagination :table="table" :loading="loading"/>
</div>
</template>
