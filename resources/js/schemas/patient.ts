import { z } from "zod";

export const CreatePatientSchema = z.object({
    nik: z.string().optional(),
    medical_record_number: z.string(),
    name: z.string({
        message: 'Nama harus diisi.'
    }),
    birth_date: z.date({
        message: "Tanggal lahir harus diisi."
    }),
    gender: z.enum([
        'male',
        'female'
    ], {
        message: "Jenis kelamin wajib diisi."
    }),
    address: z.string().optional(),
})
