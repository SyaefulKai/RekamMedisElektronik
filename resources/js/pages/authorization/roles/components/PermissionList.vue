<script setup lang="ts">
import { Checkbox } from '@/components/ui/checkbox';
import { Item, ItemContent, ItemGroup, ItemTitle } from '@/components/ui/item';
import ItemActions from '@/components/ui/item/ItemActions.vue';
import { Label } from '@/Components/ui/label';
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
    <ItemGroup v-for="[name, permissions] in Object.entries(permissionList)" :key="name" class="flex flex-col gap-4 rounded border p-8">
        {{ name }}
        <Item v-for="[permission, label] in Object.entries(permissions)" :key="permission" class="bg-input p-0">
            <Label :for="label" class="w-full flex items-center cursor-pointer p-4">
            <ItemContent>
                    <ItemTitle >
                        {{ label }}
                    </ItemTitle>
                </ItemContent>
                <ItemActions>
                    <Checkbox
                    :id="label"
                    :default-checked="permissionNames.includes(permission)"
                    :value="permission"
                    @update:checked="() => onCheck(permission)"
                    class="bg-background"
                    />
                </ItemActions>
            </Label>
        </Item>
    </ItemGroup>
</template>
