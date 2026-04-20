import { CreatePatientSchema } from "@/schemas/patient";
import { z } from "zod";

export const CreateQueueSchema = z.object({
    patient: CreatePatientSchema,
    practitioner: z.number()
})
