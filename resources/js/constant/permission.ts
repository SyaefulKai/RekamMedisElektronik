import { PermissionKey as PermissionKeyType} from "@/types/authorization/permission"

export const medicalRecordPermissions = {
  'view.medical-record': 'Lihat Rekam Medis',
  'create.medical-record': 'Buat Rekam Medis',
  'update.medical-record': 'Edit Rekam Medis',
  'delete.medical-record': 'Hapus Rekam Medis',
}

export const registrationPermissions = {
  'view.registration': 'Lihat Antrian',
  'create.registration': 'Buat Antrian',
  'update.registration': 'Edit Antrian',
  'delete.registration': 'Hapus Antrian',
}

export const userPermissions = {
    'view.user': 'Lihat Pengguna',
    'create.user': 'Tambah Pengguna',
    'update.user': 'Edit Pengguna',
    'delete.user': 'Hapus Pengguna',
}

export const rolePermissions = {
    'view.role': 'Lihat Peran',
    'create.role': 'Tambah Peran',
    'update.role': 'Edit Peran',
    'delete.role': 'Hapus Peran'
}

export const dashboardPermisions = {
  'view.dashboard': 'Lihat Dashboard',
}

export const patientPermissions = {
    'view.patient': 'Lihat Pasien',
    'create.patient': 'Tambah Pasien',
    'update.patient': 'Edit Pasien',
    'delete.patient': 'Hapus Pasien'
}

export const practitionerPermissions = {
    'view.practitioner': 'Lihat Praktisi',
    'create.practitioner': 'Daftarkan Praktisi',
    'update.practitioner': 'Edit Praktisi',
    'delete.practitioner': 'Hapus Praktisi'
}

export const permissions = {
    ...medicalRecordPermissions,
    ...registrationPermissions,
    ...userPermissions,
    ...rolePermissions,
    ...dashboardPermisions,
    ...patientPermissions,
    ...practitionerPermissions
} as const

export const PermissionKey = Object.keys(permissions) as PermissionKeyType[]
