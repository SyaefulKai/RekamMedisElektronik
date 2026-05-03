export type Icd9 = {
    code: string,
    system: string,
    display: string
}

export type Procedure = Icd9 & {
    name: string
}
