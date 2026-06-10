import { ColumnDef } from "@tanstack/vue-table";
import { Procedure } from "@/types/resources/procedure";
import { Encounter } from "@/types/resources/encounter";
import { h } from "vue";
import LinkButton from "@/components/LinkButton.vue";
import { Trash } from "lucide-vue-next";
import { destroy } from "@/actions/App/Http/Controllers/Resources/PlanController";

export const ProcedureColumn = (encounter: Encounter): ColumnDef<Procedure>[] => [
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
        href: destroy({ encounter: encounter.uuid, type: 'procedures', item: row.original.id }).url,
        label: 'Hapus',
        icon: Trash,
        variant: 'destructive'
      })
    }
  }
]
