import { deleteMethod, edit } from "@/actions/App/Http/Controllers/Auth/UserController";
import { create } from "@/actions/App/Http/Controllers/Resources/PractitionerController";
import LinkButton from "@/components/LinkButton.vue";
import { Role, SharedData, User } from "@/types";
import { Practitioner } from "@/types/resources/practitioner";
import { usePage } from "@inertiajs/vue3";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

export const UserColumn: ColumnDef<User & {
    roles: Role[],
    practitioner?: Practitioner
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
            header: 'Status Praktisi',
            cell: ({ row }) => {
                return row.original.practitioner ? 'Ya' : 'Tidak'
            }
        },
        {
            header: 'Aksi',
            cell: ({ row }) => {

                const { permissions } = usePage<SharedData>().props.auth

                const buttons = [
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
                        method: 'get',
                        label: 'Edit',
                        variant: 'secondary'
                    }),
                ]

                if (!row.original.practitioner && permissions.includes('create.practitioner')) buttons.push(h(LinkButton, {
                    href: create({
                        user: row.original.id,
                    }).url,
                    label: 'Daftarkan Praktisi',
                    class: 'bg-green-800 text-white hover:bg-green-900'
                }))

                return h('div', { class: 'flex gap-4' }, buttons)
            }
        }
    ]
