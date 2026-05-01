export const DiagnosisRole = {
  PRINCIPAL: 'principal',
  SECONDARY: 'secondary',
  ADMITTING: 'admitting',
  BILLING: 'billing',
} as const;

export type DiagnosisRole = typeof DiagnosisRole[keyof typeof DiagnosisRole];

export const DiagnosisStatus = {
  DIFFERENTIAL: 'differential',
  PROVISIONAL: 'provisional',
  CONFIRMED: 'confirmed',
  REFUTED: 'refuted',
} as const;

export type DiagnosisStatus = typeof DiagnosisStatus[keyof typeof DiagnosisStatus];

export const DiagnosisRoleLabel: Record<DiagnosisRole, string> = {
  principal: 'Diagnosis Utama',
  secondary: 'Diagnosis Sekunder',
  admitting: 'Diagnosis Saat Masuk',
  billing: 'Diagnosis untuk Klaim',
};

export const DiagnosisStatusLabel: Record<DiagnosisStatus, string> = {
  differential: 'Diagnosis Banding',
  provisional: 'Diagnosis Sementara',
  confirmed: 'Diagnosis Terkonfirmasi',
  refuted: 'Diagnosis Disangkal',
};

export const DiagnosisSystem = {
  ICD10: 'http://hl7.org/fhir/sid/icd-10',
//   SNOMED: 'http://snomed.info/sct',
} as const;

export type DiagnosisSystem =
  typeof DiagnosisSystem[keyof typeof DiagnosisSystem];
