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

export const vitalSignsSchema = z.object({
    systolic: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(60, 'Minimal 60 mmHg')
        .max(250, 'Maksimal 250 mmHg')
        .nullable()
        .optional(),

    diastolic: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(40, 'Minimal 40 mmHg')
        .max(150, 'Maksimal 150 mmHg')
        .nullable()
        .optional(),

    heart_rate: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(30, 'Minimal 30 bpm')
        .max(250, 'Maksimal 250 bpm')
        .nullable()
        .optional(),

    respiratory_rate: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(5, 'Minimal 5 x/mnt')
        .max(60, 'Maksimal 60 x/mnt')
        .nullable()
        .optional(),

    temperature: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(30, 'Minimal 30°C')
        .max(43, 'Maksimal 43°C')
        .nullable()
        .optional(),

    oxygen_saturation: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(50, 'Minimal 50%')
        .max(100, 'Maksimal 100%')
        .nullable()
        .optional(),

    weight: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(1, 'Minimal 1 kg')
        .max(300, 'Maksimal 300 kg')
        .nullable()
        .optional(),

    height: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(50, 'Minimal 50 cm')
        .max(250, 'Maksimal 250 cm')
        .nullable()
        .optional(),

    bmi: z.coerce.number({ invalid_type_error: 'Harus berupa angka' })
        .min(1)
        .max(100)
        .nullable()
        .optional(),
}).refine(
    (data) => {
        if (data.systolic && !data.diastolic) return false;
        if (!data.systolic && data.diastolic) return false;
        return true;
    },
    {
        message: 'Sistol dan diastol harus diisi keduanya',
        path: ['diastolic'],
    }
);

export const ObjectiveSchema = z.object({
    vital_signs: vitalSignsSchema.optional(),
    physical_examination: z.string().max(5000).nullable().optional(),
});

export type VitalSigns = z.infer<typeof vitalSignsSchema>;
export type ObjectiveSchemaType = z.infer<typeof ObjectiveSchema>;
