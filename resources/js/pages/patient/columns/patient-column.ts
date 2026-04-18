import { deleteMethod } from "@/actions/App/Http/Controllers/Resources/PatientController";
import LinkButton from "@/components/LinkButton.vue";
import { edit } from "@/routes/patient";
import { Patient } from "@/types/resources/patient";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

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
    {
        header: 'Aksi',
        cell: ({ row }) => {
            return h('div', {
                class: 'flex gap-4'
            }, [
                h(LinkButton, {
                    href: deleteMethod({
                        patient: row.original.id,
                    }).url,
                    method: "delete",
                    label: 'Hapus',
                    variant: 'destructive'
                }),
                h(LinkButton, {
                    href: edit({
                        patient: row.original.id
                    }).url,
                    method: "get",
                    label: 'Edit',
                    variant: 'secondary'
                })
            ]);
        }
    }
]
