import { AssessmentDiagnosis } from "@/types/resources/encounter";
import { ColumnDef } from "@tanstack/vue-table";

export const Icd10Column: ColumnDef<AssessmentDiagnosis>[] = [
    {
        header: 'Nomor',
        cell: ({ row }) => row.index + 1
    },
    {
        header: 'Peran Diagnosa',
        accessorKey: 'diagnosis_role'
    },
    {
        header: 'Status Diagnosa',
        accessorKey: 'diagnosis_status'
    },
    {
        header: 'Kode Diagnosa',
        accessorKey: 'code'
    },
    {
        header: 'Detail Diagnosa',
        accessorKey: 'display'
    }
]
