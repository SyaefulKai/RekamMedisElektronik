<script setup lang="ts">
import { Item, ItemActions, ItemDescription, ItemContent } from '@/components/ui/item';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Role } from '@/types';
import { computed } from 'vue';

const props = defineProps<{
    modelValue?: number,
    roles: Role[]
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', val: number): void
}>()

const modelProxy = computed({
    get: () => props.modelValue,
    set: (value: unknown) => {
        emit('update:modelValue', Number(value))
    }
})

</script>
<template>
    <RadioGroup v-model="modelProxy" class="cursor-pointer">
        <Item v-for="role in roles" :key="role.id" class="bg-input">
            <ItemContent>
                <Label :for="role.name" class="cursor-pointer">
                    <ItemDescription>{{ role.name }}</ItemDescription>
                </Label>
            </ItemContent>
            <ItemActions>
                <RadioGroupItem :id="role.name" :value="role.id"/>
            </ItemActions>
        </Item>
    </RadioGroup>
</template>
