import { Patient } from "@/types/resources/patient";
import { ColumnDef } from "@tanstack/vue-table";

export const PatientColumn = (): ColumnDef<Patient>[] => [
    {
        accessorKey: 'medical_record_number',
        header: 'Nomor Rekam Medis',
    },
    {
        accessorKey: 'name',
        header: 'Nama'
    },
    {
        accessorKey: 'birth_date',
        header: 'Tanggal Lahir'
    },
]
