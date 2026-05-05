import { MedicationMasterSchema } from "@/schemas/medication";
import { z } from "zod";

export type MedicationMaster = z.infer<typeof MedicationMasterSchema>
export type Medication = MedicationMaster
