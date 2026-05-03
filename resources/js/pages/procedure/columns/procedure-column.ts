import { Procedure } from '@/types/resources/procedure';
import { ColumnDef } from '@tanstack/vue-table';

export const ProcedureColumn: ColumnDef<Procedure>[] = [
    {
        header: 'Nama Tindakan',
        accessorKey: 'name',
    },
];
