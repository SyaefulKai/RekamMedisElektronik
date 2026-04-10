<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardHeader, CardTitle, CardFooter, CardContent } from '@/components/ui/card';
import { Role } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    roles: Role[]
}>()

</script>

<template>
    <Card v-for="role in roles" :key="role.id">
        <CardHeader>
            <CardTitle>{{ role.name }}</CardTitle>
        </CardHeader>
        <CardContent>
            {{ role.permissions.length }} izin
        </CardContent>
        <CardFooter class="flex gap-2 justify-end">
            <Button variant="destructive">Hapus</Button>
            <Button variant="secondary" as-child>
                <Link :href="`/roles/${role.id}`">
                    Edit
                </Link>
            </Button>
        </CardFooter>
    </Card>
</template>
