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
