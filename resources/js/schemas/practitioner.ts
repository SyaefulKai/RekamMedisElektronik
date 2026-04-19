import { z } from "zod";

export const practitionerTypes = [
    { value: 'doctor', label: 'Dokter' },
    { value: 'nurse', label: 'Perawat' },
    { value: 'midwife', label: 'Bidan' },
    { value: 'pharmacist', label: 'Apoteker' },
    { value: 'dentist', label: 'Dokter Gigi' },
] as const;

const practitionerTypeValues = practitionerTypes.map(p => p.value) as [
    (typeof practitionerTypes)[number]['value'],
    ...(typeof practitionerTypes)[number]['value'][]
];

export const CreatePractitionerSchema = z.object({
    nik: z
        .string({ required_error: 'NIK harus diisi' })
        .length(16, { message: 'NIK harus 16 digit' })
        .regex(/^\d+$/, { message: 'NIK hanya boleh berisi angka' }),

    type: z.enum(practitionerTypeValues, {
        required_error: 'Tipe praktisi harus dipilih',
        invalid_type_error: 'Tipe praktisi tidak valid'
    }),
});
