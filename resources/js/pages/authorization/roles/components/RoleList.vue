<script setup lang="ts">
import { Item, ItemActions, ItemContent, ItemTitle } from '@/components/ui/item';
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Role } from '@/types';
import { AcceptableValue } from 'reka-ui';
import { computed } from 'vue';

const props = defineProps<{
    modelValue?: AcceptableValue;
    roles: Role[];
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', val: string): void;
}>();

const modelProxy = computed({
    get: () => String(props.modelValue),
    set: (value: unknown) => {
        emit('update:modelValue', String(value));
    },
});
</script>
<template>
    <RadioGroup v-model="modelProxy" class="cursor-pointer">
        <Item v-for="role in roles" :key="role.id" class="bg-input p-0 border-border">
            <Label :for="role.name" class="cursor-pointer p-4 flex justify-between items-center w-full">
                <ItemContent>
                    <ItemTitle>{{ role.name }}</ItemTitle>
                </ItemContent>
                <ItemActions>
                    <RadioGroupItem :id="role.name" :value="String(role.id)" />
                </ItemActions>
            </Label>
            </Item>
    </RadioGroup>
</template>
