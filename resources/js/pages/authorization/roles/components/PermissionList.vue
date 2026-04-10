<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { dashboardPermisions, medicalRecordPermissions, registrationPermissions } from '@/constant/permission';
import { Permission } from '@/types';
import { computed, ref } from 'vue';

const props = defineProps<{
    permissions: Permission[];
}>();

const permissionNames = computed(() => {
    return props.permissions.map((permission) => permission.name)
})
const selectedPermissions = ref<string[]>([
    ...permissionNames.value
]);

const permissionList = {
    'Rekam Medis': medicalRecordPermissions,
    Antrian: registrationPermissions,
    Dashboard: dashboardPermisions,
};


const onCheck = (key: string) => {
    if (selectedPermissions.value.includes(key)) {
        selectedPermissions.value = selectedPermissions.value.filter((p) => p !== key);
    } else {
        selectedPermissions.value.push(key);
    }

    emit('checked', selectedPermissions.value);
};

const emit = defineEmits<{
    (e: 'checked', value: string[]): void;
}>();

</script>

<template>
    <Card v-for="[name, permissions] in Object.entries(permissionList)" :key="name" class="m-4">
        <CardHeader>
            <CardTitle>
                {{ name }}
            </CardTitle>
        </CardHeader>
        <CardContent>
            <div v-for="[permission, label] in Object.entries(permissions)" :key="permission" class="flex items-center gap-2 py-2">
                <Checkbox :default-checked="permissionNames.includes(permission)" :value="permission" @update:checked="() => onCheck(permission)" />
                {{ label }}
            </div>
        </CardContent>
    </Card>
</template>
