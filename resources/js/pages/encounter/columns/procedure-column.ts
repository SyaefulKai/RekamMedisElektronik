import { ColumnDef } from "@tanstack/vue-table";
import { Procedure } from "@/types/resources/procedure";
import { h } from "vue";
import LinkButton from "@/components/LinkButton.vue";
import { Trash } from "lucide-vue-next";

export const ProcedureColumn = (encounter: any): ColumnDef<Procedure>[] => [
  {
    header: 'Nomor',
    cell: ({ row }) => row.index + 1
  },
  {
    header: 'Kode',
    accessorKey: 'code'
  },
  {
    header: 'Nama',
    accessorKey: 'name'
  },
  {
    header: 'Deskripsi',
    accessorKey: 'display'
  },
  {
    header: 'Aksi',
    cell: ({ row }) => {
      return h(LinkButton, {
        method: 'delete',
        // TODO: ganti dengan route/href yang sesuai
        href: '#',
        label: 'Hapus',
        icon: Trash,
        variant: 'destructive'
      })
    }
  }
]
