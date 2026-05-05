import { MedicationForm, MedicationFormLabel, MedicationUnit, MedicationUnitLabel } from "@/constant/medication";
import { Medication } from "@/types/resources/medication";
import { ColumnDef } from "@tanstack/vue-table";

export const MedicationColumn: ColumnDef<Medication>[] = [
    {
        accessorKey: 'generic_name',
        header: 'Nama Generik',
    },
    {
        accessorKey: 'trade_name',
        header: 'Merek Dagang'
    },
    {
        accessorKey: 'strength',
        header: 'Kadar Zat Aktif'
    },
    {
        header: 'Bentuk',
        cell: ({row}) => MedicationFormLabel[row.original.form as MedicationForm]
    },
    {
        header: 'Satuan',
        cell: ({row}) => MedicationUnitLabel[row.original.unit as MedicationUnit]
    }
]
