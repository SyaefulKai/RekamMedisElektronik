import { index, store } from "@/actions/App/Http/Controllers/Resources/EncounterController";
import LinkButton from "@/components/LinkButton.vue";
import Badge from "@/components/ui/badge/Badge.vue";
import { Queue, QueueStatus } from "@/types/queue";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";

export const QueueColumn: ColumnDef<Queue>[] = [
    {
        accessorKey: 'queue_number',
        header: 'Nomor Antrian',
    },
    {
        header: 'Nama Pasien',
        cell: ({ row }) => {
            return row.original.patient.name
        }
    },
    {
        header: 'Status Antrian',
        cell: ({ row }) => {
            {
                type Badge = {
                    class: string;
                    text: string;
                };

                const badgeProps: Record<QueueStatus, Badge> = {
                    planned: {
                        class: 'bg-amber-100 text-amber-800 hover:bg-amber-200 dark:bg-amber-900 dark:text-amber-100 dark:hover:bg-amber-800',
                        text: 'Menunggu Antrian'
                    },
                    "in-progress": {
                        class: 'bg-blue-100 text-blue-800 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-100 dark:hover:bg-blue-800',
                        text: 'Sedang Diperiksa'
                    },
                    finished: {
                        class: 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900 dark:text-green-100 dark:hover:bg-green-800',
                        text: 'Selesai'
                    },
                    cancelled: {
                        class: 'bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900 dark:text-red-100 dark:hover:bg-red-800',
                        text: 'Dibatalkan'
                    }
                };

                const badge = badgeProps[row.original.status];

                return h(Badge, {
                    class: badge.class
                }, badge.text)
            }
        }
    },
    {
        header: 'Aksi',
        cell: ({ row }) => {
            const status = row.original.status as QueueStatus

            const buttonProps: Record<QueueStatus, any> = {
                planned: {
                    method: 'post',
                    href: store().url,
                    data: {
                        patient_id: row.original.patient.id,
                        practitioner_id: row.original.practitioner.user.id,
                        queue_id: row.original.id
                    }
                },
                'in-progress': {
                    method: 'get',
                    href: index({
                        encounter: row.original.encounter.uuid
                    }).url,
                    data: {}
                },
                finished: null,
                cancelled: null
            }

            const config = buttonProps[status]

            return config
                ? h(LinkButton, {
                    href: config.href,
                    method: config.method,
                    label: 'Rekam Medis',
                    data: config.data
                })
                : null
        }
    }
]
