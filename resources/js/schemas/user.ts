import { z } from "zod"

export const CreateUserSchema = z.object({
    name: z.string(),
    email: z.string().email(),
    password: z.string().min(5),
    role: z.coerce.number(),
})

export const EditUserSchema = CreateUserSchema.omit({
    password: true
})
