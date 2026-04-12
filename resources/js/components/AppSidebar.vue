<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { index as UserIndex, create as UserCreate } from '@/routes/user';
import { index as RoleIndex, create as RoleCreate } from '@/actions/App/Http/Controllers/Authorization/RoleController';
import { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, PersonStanding, Shield, ShieldPlus, User, UserPlus } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import NavAuthorization from './NavAuthorization.vue';
import NavUserManagement from './NavUserManagement.vue';
import { index as PatientIndex } from '@/actions/App/Http/Controllers/Resources/PatientController';
import NavPatientManagement from '@/components/NavPatientManagement.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
];

const authorization: NavItem[] = [
    {
        title: 'Peran',
        href: RoleIndex().url,
        permission: "view.role",
    },
    {
        title: 'Tambah Peran',
        href: RoleCreate().url,
        permission: 'create.role',
    }
];

const userManagement: NavItem[] = [
    {
        title: 'Pengguna',
        href: UserIndex().url,
        permission: 'view.user',
    },
    {
        title: 'Tambah Pengguna',
        href: UserCreate().url,
        permission: 'create.user'
    }
];

const patientManagement: NavItem[] = [
    {
        title: 'Pasien',
        href: PatientIndex().url,
        permission: 'view.patient'
    }
]

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits',
        icon: BookOpen,
    },
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

        <SidebarContent class="p-4 md:p-0 lg:p-0">
            <NavMain :items="mainNavItems" />
            <NavPatientManagement :items="patientManagement"/>
            <NavAuthorization :items="authorization" />
            <NavUserManagement :items="userManagement" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
