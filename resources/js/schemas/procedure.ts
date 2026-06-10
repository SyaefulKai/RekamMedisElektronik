import { z } from 'zod'

export const CreateProcedureSchema = z.object({
  code: z.string().min(1, 'Kode harus diisi'),
  system: z.string().min(1, 'Sistem harus diisi'),
  display: z.string().min(1, 'Display harus diisi'),
  name: z.string().min(1, 'Nama harus diisi'),
})

export type CreateProcedureInput = z.infer<typeof CreateProcedureSchema>
