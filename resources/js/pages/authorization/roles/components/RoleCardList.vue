<script setup lang="ts">
import { deleteMethod, edit } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Role } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    roles: Role[];
}>();
</script>

<template>
    <Card v-for="role in roles" :key="role.id">
        <CardHeader>
            <CardTitle>{{ role.name }}</CardTitle>
        </CardHeader>
        <CardContent> {{ role.permissions.length }} izin </CardContent>
        <CardFooter class="flex justify-end gap-2">
            <Button variant="destructive" as-child>
                <Link
                    :href="
                        deleteMethod({
                            role: role.id,
                        }).url
                    "
                    method="delete"
                >
                    Hapus
                </Link>
            </Button>
            <Button variant="secondary" as-child>
                <Link :href="edit({
                    role: role.id
                })"> Edit </Link>
            </Button>
        </CardFooter>
    </Card>
</template>
