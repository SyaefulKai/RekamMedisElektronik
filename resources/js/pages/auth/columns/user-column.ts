import { User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";

export const UserColumn: ColumnDef<User>[] = [
    {
        accessorKey: 'name',
        header: 'Nama'
    },
    {
        accessorKey: 'email',
        header: 'Email'
    }
]
