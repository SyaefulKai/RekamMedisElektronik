import { Practitioner } from "@/types/resources/practitioner";
import { ColumnDef } from "@tanstack/vue-table";

export const PractitionerColumn: () => ColumnDef<Practitioner>[] = () =>[
    {
        accessorKey: 'user.name',
        header: 'Nama',
    },
    {
        accessorKey: 'type',
        header: 'Tipe'
    }
]
