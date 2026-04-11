export type Role = {
    id: number,
    name: string
}

export type CreateRoleRequest = {
    name: string,
    permissions?: string[]
}
