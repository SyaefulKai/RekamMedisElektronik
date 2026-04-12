import { Patient } from "@/types/resources/patient";
import { ColumnDef } from "@tanstack/vue-table";

export const PatientColumn = (): ColumnDef<Patient>[] => [
    {
        accessorKey: 'name',
        header: 'Nama'
    },
    {
        accessorKey: 'birth_date',
        header: 'Tanggal Lahir'
    },
]
