<script setup lang="ts">
import { Item, ItemActions, ItemContent, ItemDescription } from '@/components/ui/item';
import { Label } from '@/Components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Role } from '@/types';
import { computed } from 'vue';

const props = defineProps<{
    modelValue?: number;
    roles: Role[];
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', val: number): void;
}>();

const modelProxy = computed({
    get: () => props.modelValue,
    set: (value: unknown) => {
        emit('update:modelValue', Number(value));
    },
});
</script>
<template>
    <RadioGroup v-model="modelProxy" class="cursor-pointer">
        <Item v-for="role in roles" :key="role.id" class="bg-input p-0">
            <Label :for="role.name" class="cursor-pointer p-4 flex justify-between items-center w-full">
                <ItemContent>
                    <ItemDescription>{{ role.name }}</ItemDescription>
                </ItemContent>
                <ItemActions>
                    <RadioGroupItem :id="role.name" :value="role.id" />
                </ItemActions>
            </Label>
            </Item>
    </RadioGroup>
</template>
