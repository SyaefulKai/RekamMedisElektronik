import { deleteMethod } from "@/actions/App/Http/Controllers/Resources/AssessmentDiagnosisController";
import LinkButton from "@/components/LinkButton.vue";
import { AssessmentDiagnosis, Encounter } from "@/types/resources/encounter";
import { ColumnDef } from "@tanstack/vue-table";
import { Trash } from "lucide-vue-next";
import { h } from "vue";

export const Icd10Column: (encounter: Encounter) => ColumnDef<AssessmentDiagnosis>[] = (
    encounter: Encounter
) => [
    {
        header: 'Nomor',
        cell: ({ row }) => row.index + 1
    },
    {
        header: 'Peran Diagnosa',
        accessorKey: 'diagnosis_role'
    },
    {
        header: 'Status Diagnosa',
        accessorKey: 'diagnosis_status'
    },
    {
        header: 'Kode Diagnosa',
        accessorKey: 'code'
    },
    {
        header: 'Detail Diagnosa',
        accessorKey: 'display'
    },
    {
        header: 'Aksi',
        cell: ({row}) => {
            return h(LinkButton, {
                method: 'delete',
                href: deleteMethod({
                    encounter: encounter.uuid,
                    diagnosis: row.original.id
                }).url,
                label: 'Hapus',
                icon: Trash,
                variant: 'destructive'

            })
        }
    }
]

