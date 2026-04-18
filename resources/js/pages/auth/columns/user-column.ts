import { deleteMethod, edit } from "@/actions/App/Http/Controllers/Auth/UserController";
import { create } from "@/actions/App/Http/Controllers/Resources/PractitionerController";
import LinkButton from "@/components/LinkButton.vue";
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
                    h(LinkButton, {
                        href: deleteMethod({
                            user: row.original.id,
                        }).url,
                        method: 'delete',
                        label: 'Hapus',
                        variant: 'destructive'
                    }),
                    h(LinkButton, {
                        href: edit({
                            user: row.original.id,
                        }).url,
                        method: 'patch',
                        label: 'Edit',
                        variant: 'secondary'
                    }),
                    h(LinkButton, {
                        href: create({
                            user: row.original.id,
                        }).url,
                        label: 'Daftarkan Praktisi',
                        class: 'bg-green-800 text-white hover:bg-green-900'
                    })
                ])
            }
        }
    ]
