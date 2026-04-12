import DeleteUserButton from "@/pages/auth/components/DeleteUserButton.vue";
import EditUserButton from "@/pages/auth/components/EditUserButton.vue";
import { Role, User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

export const UserColumn = (onDelete: (user: User) => void, onEdit: (user: User) => void): ColumnDef<User & {
    roles: Role[]
}>[] => [
    {
        accessorKey: 'name',
        header: 'Nama'
    },
    {
        accessorKey: 'email',
        header: 'Email'
    },
    {
        header: 'Peran',
        cell: ({row}) => {
            return row.original?.roles[0]?.name
        }
    },
    {
        header: 'Aksi',
        cell: ({ row }) => {
            return h('div', { class: 'flex gap-4' }, [
                h(DeleteUserButton, {
                    user: row.original,
                    onDelete: () => onDelete(row.original)
                }),
                h(EditUserButton, {
                    user: row.original,
                    onEdit: () => onEdit(row.original)
                })
            ])
        }
    }
]
