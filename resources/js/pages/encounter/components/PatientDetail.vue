<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { Patient } from '@/types/resources/patient';
import { ChevronDown } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    patient: Patient;
}>();

const isOpen = ref(false);

const calculateAge = (dob: string) => {
    const today = new Date();
    const birth = new Date(dob);

    let years = today.getFullYear() - birth.getFullYear();
    let months = today.getMonth() - birth.getMonth();
    let days = today.getDate() - birth.getDate();

    if (days < 0) {
        months--;
        days += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
    }
    if (months < 0) {
        years--;
        months += 12;
    }

    return { years, months, days };
};

const { years, months, days } = calculateAge(props.patient.birth_date);
</script>

<template>
    <div class="flex flex-col divide-y rounded border lg:flex-row lg:divide-x lg:divide-y-0">
        <div class="w-full p-4">
            <h4 class="text-base font-semibold md:text-lg">Nomor Rekam Medis</h4>
            <small class="text-sm">{{ patient.medical_record_number }}</small>
        </div>

        <div class="w-full p-4">
            <h4 class="text-base font-semibold md:text-lg">Nama</h4>
            <small class="text-sm">{{ patient.name }}</small>
        </div>

        <div class="w-full p-4">
            <h4 class="text-base font-semibold md:text-lg">Usia</h4>
            <div class="flex gap-4">
                <small class="text-sm">{{ `${years} tahun` }}</small>
                <small class="text-sm">{{ `${months} bulan` }}</small>
                <small class="text-sm">{{ `${days} hari` }}</small>
            </div>
        </div>
    </div>
    <Collapsible v-model:open="isOpen">
        <CollapsibleTrigger class="flex w-full items-center justify-between p-4 text-start border rounded">
            <span class="text-sm font-medium">Lihat Detail</span>
            <ChevronDown class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': isOpen }" />
        </CollapsibleTrigger>

        <CollapsibleContent>
            <div class="divide-y border rounded">
                <div class="w-full p-4">
                    <h4 class="text-base font-semibold md:text-lg">Tanggal Lahir</h4>
                    <small class="text-sm">{{ patient.birth_date }}</small>
                </div>

                <div class="w-full p-4">
                    <h4 class="text-base font-semibold md:text-lg">Alamat</h4>
                    <small class="text-sm">{{ patient.address }}</small>
                </div>

                <div class="w-full p-4">
                    <h4 class="text-base font-semibold md:text-lg">Pekerjaan</h4>
                    <small class="text-sm">{{ patient.occupation }}</small>
                </div>
            </div>
        </CollapsibleContent>
    </Collapsible>
</template>
