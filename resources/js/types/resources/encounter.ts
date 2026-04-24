export const EncounterStatus = {
    Arrived: 'arrived',
    InProgress: 'in-progress',
    Finished: 'finished',
    Cancelled: 'cancelled',
} as const

export type EncounterStatus = (typeof EncounterStatus)[keyof typeof EncounterStatus]


export type Encounter = {
    id: number,
    uuid: string,
    status: EncounterStatus,
    date: string
}
