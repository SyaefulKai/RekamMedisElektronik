import { MedicationForm, MedicationUnit } from "@/constant/medication";
import { z } from "zod";

export const MedicationMasterSchema = z.object({
	generic_name: z.string({
        message: 'Nama generik obat wajib diisi'
    }).min(1, 'Nama generik obat wajib diisi'),
    trade_name: z.string({
        message: 'Nama dagang obat wajib diisi'
    }).min(1, 'Nama dagang obat wajib diisi'),
	strength: z.string().optional(),
	form: z.enum(
        Object.values(MedicationForm) as [string, ...string[]]
    ),
	unit: z.enum(
        Object.values(MedicationUnit) as [string, ...string[]]
    ),
	is_active: z.boolean().default(true)
});
