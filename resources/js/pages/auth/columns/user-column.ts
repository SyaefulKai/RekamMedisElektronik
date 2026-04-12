import DeleteUserButton from "@/pages/auth/components/DeleteUserButton.vue";
import { User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

export const UserColumn = (onDelete: (user: User) => void): ColumnDef<User>[] => [
    {
        accessorKey: 'name',
        header: 'Nama'
    },
    {
        accessorKey: 'email',
        header: 'Email'
    },
    {
        header: 'Aksi',
        cell: ({ row }) => {
            return h('div', { class: 'flex gap-4' }, [
                h(DeleteUserButton, {
                    user: row.original,
                    onDelete: () => onDelete(row.original)
                })
            ])
        }
    }
]
