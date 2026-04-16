import { deleteMethod, edit } from "@/actions/App/Http/Controllers/Auth/UserController";
import DeleteResourceButton from "@/components/DeleteResourceButton.vue";
import EditResourceButton from "@/components/EditResourceButton.vue";
import { Role, User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

export const UserColumn: ColumnDef<User & {
    roles: Role[]
}>[] = [
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
            cell: ({ row }) => {
                return row.original?.roles[0]?.name
            }
        },
        {
            header: 'Aksi',
            cell: ({ row }) => {
                return h('div', { class: 'flex gap-4' }, [
                    h(DeleteResourceButton, {
                        path: deleteMethod({
                            user: row.original.id,
                        }).url
                    }),
                    h(EditResourceButton, {
                        path: edit({
                            user: row.original.id,
                        }).url
                    })
                ])
            }
        }
    ]
