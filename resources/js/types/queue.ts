import { Encounter } from "@/types/resources/encounter";
import { Patient } from "@/types/resources/patient"
import { Practitioner } from "@/types/resources/practitioner"

export const QueueStatus = {
  Planned: 'planned',
  InProgress: 'in-progress',
  Finished: 'finished',
  Cancelled: 'cancelled'
} as const;

export type QueueStatus = (typeof QueueStatus)[keyof typeof QueueStatus];

export type Queue = {
    id: number,
    patient: Patient,
    practitioner: Practitioner,
    encounter: Encounter,
    queue_number: number,
    status: QueueStatus,
}
