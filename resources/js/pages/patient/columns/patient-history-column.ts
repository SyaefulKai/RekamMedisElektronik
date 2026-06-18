import LinkButton from "@/components/LinkButton.vue";
import { Encounter } from "@/types/resources/encounter";
import { ColumnDef } from "@tanstack/vue-table";
import { Eye } from "lucide-vue-next";
import { h } from "vue";

export const PatientHistoryColumn = (): ColumnDef<Encounter>[] => [
    {
        accessorKey: 'date',
        header: 'Tanggal',
        cell: ({ row }) => {
            const date = new Date(row.original.date);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            });
        },
    },
    {
        header: 'Dokter',
        cell: ({ row }) => {
            const practitioner = row.original.practitioner;
            return practitioner?.user?.name ?? '-';
        },
    },
    {
        header: 'Keluhan Utama',
        cell: ({ row }) => {
            return row.original.subjective?.chief_complaint ?? '-';
        },
    },
    {
        header: 'Diagnosis',
        cell: ({ row }) => {
            const diagnoses = row.original.assessment?.assessment_diagnoses;
            if (!diagnoses || diagnoses.length === 0) return '-';
            return diagnoses.map((d) => `${d.code} - ${d.display}`).join(', ');
        },
    },
    {
        header: 'Aksi',
        cell: ({ row }) => {
            return h(LinkButton, {
                href: `/encounters/${row.original.uuid}`,
                method: 'get',
                label: 'Lihat',
                variant: 'outline',
                icon: Eye,
            });
        },
    },
];
