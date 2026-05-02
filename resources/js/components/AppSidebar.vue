<script setup lang="ts">
import { index as RoleIndex } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import { index as QueueIndex } from '@/actions/App/Http/Controllers/QueueController';
import { index as PatientIndex } from '@/actions/App/Http/Controllers/Resources/PatientController';
import { index as PractitionerIndex } from '@/actions/App/Http/Controllers/Resources/PractitionerController';
import { index as ProcedureIndex } from '@/actions/App/Http/Controllers/Resources/ProcedureController';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavGroup from '@/components/NavGroup.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { index as UserIndex } from '@/routes/user';
import { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, Hammer, LayoutGrid, ListOrdered, ShieldCheck, Stethoscope, UserCog, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    { title: 'Dashboard', href: '/dashboard', icon: LayoutGrid },
    { title: 'Antrian', href: QueueIndex().url, icon: ListOrdered },

];

const patientManagement: NavItem[] = [
    { title: 'Data Pasien', href: PatientIndex().url, permission: 'view.patient' },
];

const authorization: NavItem[] = [
    { title: 'Peran', href: RoleIndex().url, permission: 'view.role' },
];

const userManagement: NavItem[] = [
    { title: 'Data Pengguna', href: UserIndex().url, permission: 'view.user' },
];

const practitionerManagement: NavItem[] = [
    { title: 'Data Praktisi', href: PractitionerIndex().url, permission: 'view.practitioner' },
];

const procedureManagement: NavItem[] = [
    { title: 'Data Tindakan', href: ProcedureIndex().url, permission: 'view.procedure' },
];

const footerNavItems: NavItem[] = [
    { title: 'Github Repo', href: 'https://github.com/laravel/vue-starter-kit', icon: Folder },
    { title: 'Documentation', href: 'https://laravel.com/docs/starter-kits', icon: BookOpen },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <NavGroup label="Pasien"   :icon="Users"       permission="view.patient"       :items="patientManagement" />
            <NavGroup label="Manajemen Peran"    :icon="ShieldCheck" permission="view.role"           :items="authorization" />
            <NavGroup label="Pengguna" :icon="UserCog"     permission="view.user"           :items="userManagement" />
            <NavGroup label="Praktisi" :icon="Stethoscope" permission="view.practitioner"   :items="practitionerManagement" />
            <NavGroup label="Tindakan" :icon="Hammer"      permission="view.practitioner"   :items="procedureManagement" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
