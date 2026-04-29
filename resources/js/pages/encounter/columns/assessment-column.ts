import { Icd10 } from "@/types/resources/encounter";
import { ColumnDef } from "@tanstack/vue-table";

export const Icd10Column: ColumnDef<Icd10>[] = [
    {
        header: 'Nomor',
        cell: ({row}) => row.index + 1
    },
    {
        accessorKey: 'icd10_code',
        header: 'Kode Diagnosa',
    },
    {
        accessorKey: 'icd10_id',
        header: 'Deskripsi Diagnosa',
    }
]
