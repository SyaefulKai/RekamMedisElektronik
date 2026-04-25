<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Field as VeeField, useFieldArray, useFormContext } from 'vee-validate';

useFormContext();
const { fields, push, remove } = useFieldArray('allergies');
</script>

<template>
    <div class="space-y-4">
        <div v-for="(field, index) in fields" :key="field.key" class="space-y-3 rounded-lg border p-4">
            <div>
                <Label>Nama Alergen</Label>
                <VeeField :name="`allergies[${index}].name`" v-slot="{ field }">
                    <Input :model-value="field.value" @update:model-value="field.onChange" placeholder="cth: Penisilin, Kuning telur" />
                </VeeField>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <Label>Tipe</Label>
                    <VeeField :name="`allergies[${index}].type`" v-slot="{ field }">
                        <Select :model-value="field.value" @update:model-value="field.onChange">
                            <SelectTrigger>
                                <SelectValue placeholder="Pilih tipe" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="allergy">Alergi</SelectItem>
                                <SelectItem value="intolerance">Intoleransi</SelectItem>
                            </SelectContent>
                        </Select>
                    </VeeField>
                </div>

                <div>
                    <Label>Kategori</Label>
                    <VeeField :name="`allergies[${index}].category`" v-slot="{ field }">
                        <Select :model-value="field.value" @update:model-value="field.onChange">
                            <SelectTrigger>
                                <SelectValue placeholder="Pilih kategori" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="food">Makanan</SelectItem>
                                <SelectItem value="medication">Obat</SelectItem>
                                <SelectItem value="environment">Lingkungan</SelectItem>
                                <SelectItem value="biologic">Biologis</SelectItem>
                            </SelectContent>
                        </Select>
                    </VeeField>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <Label>Tingkat Bahaya</Label>
                    <VeeField :name="`allergies[${index}].criticality`" v-slot="{ field }">
                        <Select :model-value="field.value" @update:model-value="field.onChange">
                            <SelectTrigger>
                                <SelectValue placeholder="Pilih tingkat bahaya" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="low">Rendah</SelectItem>
                                <SelectItem value="high">Tinggi</SelectItem>
                                <SelectItem value="unable-to-assess">Tidak Dapat Dinilai</SelectItem>
                            </SelectContent>
                        </Select>
                    </VeeField>
                </div>

                <div>
                    <Label>Tingkat Keparahan</Label>
                    <VeeField :name="`allergies[${index}].severity`" v-slot="{ field }">
                        <Select :model-value="field.value" @update:model-value="field.onChange">
                            <SelectTrigger>
                                <SelectValue placeholder="Pilih tingkat keparahan" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="mild">Ringan</SelectItem>
                                <SelectItem value="moderate">Sedang</SelectItem>
                                <SelectItem value="severe">Berat</SelectItem>
                            </SelectContent>
                        </Select>
                    </VeeField>
                </div>
            </div>

            <div>
                <Label>Manifestasi</Label>
                <VeeField :name="`allergies[${index}].manifestation`" v-slot="{ field }">
                    <Input :model-value="field.value" @update:model-value="field.onChange" placeholder="cth: Ruam kulit, Anafilaksis" />
                </VeeField>
            </div>

            <Button type="button" variant="destructive" size="sm" @click="remove(index)"> Hapus </Button>
        </div>

        <Button
            type="button"
            variant="outline"
            @click="push({ name: '', type: null, category: null, criticality: null, severity: null, manifestation: null })"
        >
            + Tambah Alergi
        </Button>
    </div>
</template>
