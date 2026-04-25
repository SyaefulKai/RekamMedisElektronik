import { Patient } from "@/types/resources/patient"

export const EncounterStatus = {
    Arrived: 'arrived',
    InProgress: 'in-progress',
    Finished: 'finished',
    Cancelled: 'cancelled',
} as const

export const AllergyType = {
    Allergy: 'allergy',
    Intolerance: 'intolerance'
} as const

export const AllergyCategory = {
    Food: 'food',
    Medication: 'medication',
    Environment: 'environment',
    Biologic: 'biologic'
} as const

export const AllergyCriticality = {
    Low: 'low',
    High: 'high',
    UnableToAssess: 'unable-to-assess'
} as const

export const AllergySeverity = {
    Mild: 'mild',
    Moderate: 'moderate',
    Severe: 'severe'
} as const

export type EncounterStatus = (typeof EncounterStatus)[keyof typeof EncounterStatus]
export type AllergyType = (typeof AllergyType)[keyof typeof AllergyType]
export type AllergyCategory = (typeof AllergyCategory)[keyof typeof AllergyCategory]
export type AllergyCriticality = (typeof AllergyCriticality)[keyof typeof AllergyCriticality]
export type AllergySeverity = (typeof AllergySeverity)[keyof typeof AllergySeverity]

export type Encounter = {
    id: number,
    uuid: string,
    status: EncounterStatus,
    date: string,
    subjective?: Subjective,
    patient?: Patient
}

export type Subjective = {
    encounter: Encounter,
    chief_complaint: string,
    history_of_present_illness: string,
    past_medical_history: string,
    family_medical_history: string,
    allergies: Allergy[]
}

export type Allergy = {
    name: string,
    type?: AllergyType,
    category?: AllergyCategory,
    criticality?: AllergyCriticality,
    severity?: AllergySeverity,
    manifestation?: string,
}
