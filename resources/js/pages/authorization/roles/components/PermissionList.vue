<script setup lang="ts">
import { Checkbox } from '@/components/ui/checkbox';
import { Item, ItemContent, ItemDescription, ItemGroup, ItemSeparator } from '@/components/ui/item';
import ItemActions from '@/components/ui/item/ItemActions.vue';
import { dashboardPermisions, medicalRecordPermissions, registrationPermissions } from '@/constant/permission';
import { Permission } from '@/types';
import { computed, ref } from 'vue';

const props = defineProps<{
    permissions: Permission[];
}>();

const permissionNames = computed(() => {
    return props.permissions.map((permission) => permission.name);
});
const selectedPermissions = ref<string[]>([...permissionNames.value]);

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
    <ItemGroup v-for="[name, permissions] in Object.entries(permissionList)" :key="name" class="rounded border p-4">
        {{ name }}
        <Item v-for="[permission, label] in Object.entries(permissions)" :key="permission">
            <ItemContent>
                <ItemDescription>
                    {{ label }}
                </ItemDescription>
            </ItemContent>
            <ItemActions>
                <Checkbox :default-checked="permissionNames.includes(permission)" :value="permission" @update:checked="() => onCheck(permission)" />
            </ItemActions>
            <ItemSeparator v-if="Object.entries(permissions).length > 1"/>
        </Item>
    </ItemGroup>
</template>
