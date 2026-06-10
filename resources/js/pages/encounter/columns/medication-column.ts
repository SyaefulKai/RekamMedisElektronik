import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";
import LinkButton from "@/components/LinkButton.vue";
import { Trash } from "lucide-vue-next";
import { destroy } from "@/actions/App/Http/Controllers/Resources/PlanController";
import { Encounter, PlanMedication } from "@/types/resources/encounter";
import { aturanPakaiOptions } from "@/constant/medication";

export const MedicationColumn = (encounter: Encounter): ColumnDef<PlanMedication>[] => [
  {
    header: 'No',
    cell: ({ row }) => row.index + 1,
  },
  {
    header: 'Nama Obat',
    accessorKey: 'name',
  },
  {
    header: 'Frekuensi',
    cell: ({ row }) => {
      const freq = row.original.frequency_per_day;
      const instr = aturanPakaiOptions.filter(aturan => aturan.value == row.original.instruction)[0].label
      const parts: string[] = [];
      if (freq) parts.push(`${freq}x/hari`);
      if (instr) parts.push(instr);
      return parts.join(', ') || '-';
    },
  },
  {
    header: 'Jumlah',
    accessorKey: 'quantity',
  },
  {
    header: 'Aksi',
    cell: ({ row }) => {
      return h(LinkButton, {
        method: 'delete',
        href: destroy({ encounter: encounter.uuid, type: 'medications', item: row.original.id }).url,
        label: 'Hapus',
        icon: Trash,
        variant: 'destructive',
      })
    },
  },
];
