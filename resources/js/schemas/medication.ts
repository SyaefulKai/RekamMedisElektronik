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


export const AddMedicationStockSchema = z.array(
    z.object({
        medication_id: z
            .number({
                required_error: 'Obat wajib dipilih',
                invalid_type_error: 'Obat tidak valid',
            })
            .int('ID obat harus berupa bilangan bulat')
            .positive('Silakan pilih obat yang valid'),

        batch_number: z
            .string()
            .trim()
            .max(100, 'Nomor batch maksimal 100 karakter')
            .nullish(),

        expired_at: z
            .string()
            .datetime('Tanggal kedaluwarsa tidak valid')
            .nullish(),

        quantity: z
            .number({
                required_error: 'Jumlah stok wajib diisi',
                invalid_type_error: 'Jumlah stok harus berupa angka',
            })
            .int('Jumlah stok harus berupa bilangan bulat')
            .min(1, 'Jumlah stok minimal 1'),

        buy_price: z
            .number({
                required_error: 'Harga beli wajib diisi',
                invalid_type_error: 'Harga beli harus berupa angka',
            })
            .int('Harga beli harus berupa bilangan bulat')
            .min(1, 'Harga beli harus lebih dari 0'),

        sell_price: z
            .number({
                required_error: 'Harga jual wajib diisi',
                invalid_type_error: 'Harga jual harus berupa angka',
            })
            .int('Harga jual harus berupa bilangan bulat')
            .min(1, 'Harga jual harus lebih dari 0'),
    })
);

export type AddMedicationStock = z.infer<typeof AddMedicationStockSchema>;
