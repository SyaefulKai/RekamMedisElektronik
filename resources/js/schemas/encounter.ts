import { z } from "zod";

const AllergySchema = z.object({
    name: z.string().min(1),
    type: z.enum(['allergy', 'intolerance']).nullable().optional(),
    category: z.enum(['food', 'medication', 'environment', 'biologic']).nullable().optional(),
    criticality: z.enum(['low', 'high', 'unable-to-assess']).nullable().optional(),
    manifestation: z.string().nullable().optional(),
    severity: z.enum(['mild', 'moderate', 'severe']).nullable().optional(),
})

export const SubjectiveSchema = z.object({
    chief_complaint: z.string().nullable().optional(),
    history_of_present_illness: z.string().nullable().optional(),
    past_medical_history: z.string().nullable().optional(),
    family_medical_history: z.string().nullable().optional(),
    allergies: z.array(AllergySchema).nullable().optional(),
})

export type SubjectiveSchemaType = z.infer<typeof SubjectiveSchema>
