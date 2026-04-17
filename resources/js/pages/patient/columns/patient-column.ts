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
        cell: ({row}) => {
            return h('div', [
                h(LinkButton, {
                    href: edit({
                        patient: row.original.id
                    }).url,
                    label: 'Edit',
                    variant: 'secondary'
                })
            ]);
        }
    }
]
