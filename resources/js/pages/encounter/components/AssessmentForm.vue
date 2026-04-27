<script setup lang="ts">
import { Icd10 } from '@/types/resources/encounter';
import { inject } from 'vue';

const icd10s = inject<Icd10[]>('icd10s')

</script>

<template>
    <p>{{ icd10s }}</p>
</template>
