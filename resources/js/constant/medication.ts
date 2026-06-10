export const MedicationUnit = {
	MG:      'mg',
	GRAM:    'g',
	ML:      'ml',
	IU:      'iu',
	TABLET:  'tablet',
	CAPSULE: 'capsule',
	AMPOULE: 'ampoule',
	BOTTLE:  'bottle',
	SACHET:  'sachet',
	TUBE:    'tube',
	OTHER:   'other',
} as const;

export type MedicationUnit = typeof MedicationUnit[keyof typeof MedicationUnit];

export const MedicationForm = {
	TABLET:      'tablet',
	CAPSULE:     'capsule',
	SYRUP:       'syrup',
	INJECTION:   'injection',
	OINTMENT:    'ointment',
	CREAM:       'cream',
	GEL:         'gel',
	SUPPOSITORY: 'suppository',
	DROPS:       'drops',
	INHALER:     'inhaler',
	PATCH:       'patch',
	POWDER:      'powder',
	OTHER:       'other',
} as const;

export type MedicationForm = typeof MedicationForm[keyof typeof MedicationForm];

export const MedicationUnitLabel: Record<MedicationUnit, string> = {
	[MedicationUnit.MG]:      'mg',
	[MedicationUnit.GRAM]:    'g',
	[MedicationUnit.ML]:      'ml',
	[MedicationUnit.IU]:      'IU',
	[MedicationUnit.TABLET]:  'Tablet',
	[MedicationUnit.CAPSULE]: 'Kapsul',
	[MedicationUnit.AMPOULE]: 'Ampul',
	[MedicationUnit.BOTTLE]:  'Botol',
	[MedicationUnit.SACHET]:  'Sachet',
	[MedicationUnit.TUBE]:    'Tube',
	[MedicationUnit.OTHER]:   'Lainnya',
};

export const MedicationFormLabel: Record<MedicationForm, string> = {
	[MedicationForm.TABLET]:      'Tablet',
	[MedicationForm.CAPSULE]:     'Kapsul',
	[MedicationForm.SYRUP]:       'Sirup',
	[MedicationForm.INJECTION]:   'Injeksi',
	[MedicationForm.OINTMENT]:    'Salep',
	[MedicationForm.CREAM]:       'Krim',
	[MedicationForm.GEL]:         'Gel',
	[MedicationForm.SUPPOSITORY]: 'Suppositoria',
	[MedicationForm.DROPS]:       'Tetes',
	[MedicationForm.INHALER]:     'Inhaler',
	[MedicationForm.PATCH]:       'Patch',
	[MedicationForm.POWDER]:      'Serbuk',
	[MedicationForm.OTHER]:       'Lainnya',
};

export const aturanPakaiOptions: {
    value: string,
    label: string
}[] = [
    {
        value: 'sebelum_makan',
        label: 'Sebelum makan'
    },
    {
        value: 'sesudah_makan',
        label: 'Sesudah makan'
    },
    {
        value: 'saat_makan',
        label: 'Saat makan'
    },
    {
        value: 'pagi_hari',
        label: 'Pagi hari'
    },
    {
        value: 'siang_hari',
        label: 'Siang hari'
    },
    {
        value: 'sore_hari',
        label: 'Sore hari'
    },
    {
        value: 'malam_hari',
        label: 'Malam hari'
    },
    {
        value: 'sebelum_tidur',
        label: 'Sebelum tidur'
    },
    {
        value: 'sesudah_tidur',
        label: 'Sesudah bangun tidur'
    },
    {
        value: 'sesudah_mandi',
        label: 'Sesudah mandi'
    },
    {
        value: 'sebelum_mandi',
        label: 'Sebelum mandi'
    },
    {
        value: 'bila_nyeri',
        label: 'Bila nyeri'
    },
    {
        value: 'bila_demam',
        label: 'Bila demam'
    },
    {
        value: 'bila_sesak',
        label: 'Bila sesak'
    },
    {
        value: 'bila_batuk',
        label: 'Bila batuk'
    },
    {
        value: 'bila_perlu',
        label: 'Bila perlu'
    },
    {
        value: 'jangan_dikunyah',
        label: 'Jangan dikunyah'
    },
    {
        value: 'dikunyah',
        label: 'Dikunyah terlebih dahulu'
    },
    {
        value: 'dihisap',
        label: 'Dihisap perlahan'
    },
    {
        value: 'ditelan_utuh',
        label: 'Ditelan utuh'
    },
    {
        value: 'larutkan_dahulu',
        label: 'Larutkan terlebih dahulu'
    },
    {
        value: 'kocok_dahulu',
        label: 'Kocok dahulu sebelum digunakan'
    },
    {
        value: 'habiskan',
        label: 'Harus dihabiskan'
    },
    {
        value: 'gunakan_rutin',
        label: 'Gunakan secara rutin'
    },
    {
        value: 'jangan_putus_obat',
        label: 'Jangan menghentikan obat tanpa anjuran dokter'
    },
    {
        value: 'oles_tipis',
        label: 'Oles tipis pada area yang sakit'
    },
    {
        value: 'oles_tebal',
        label: 'Oles secukupnya pada area yang sakit'
    },
    {
        value: 'untuk_pemakaian_luar',
        label: 'Hanya untuk pemakaian luar'
    },
    {
        value: 'hindari_mata',
        label: 'Hindari kontak dengan mata'
    },
    {
        value: 'tetes_mata',
        label: 'Teteskan pada mata'
    },
    {
        value: 'tetes_telinga',
        label: 'Teteskan pada telinga'
    },
    {
        value: 'tetes_hidung',
        label: 'Teteskan pada hidung'
    },
    {
        value: 'kumur',
        label: 'Gunakan untuk berkumur'
    },
]
