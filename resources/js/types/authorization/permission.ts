import { permissions } from "@/constant/permission"

export type Permission = {
    id: number,
    name: string
}

export type PermissionKey = keyof typeof permissions
