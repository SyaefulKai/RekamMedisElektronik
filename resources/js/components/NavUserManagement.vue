<script setup lang="ts">
import { NavItem, SharedData } from '@/types';
import { PermissionKey } from '@/types/authorization/permission';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight, UserCog } from 'lucide-vue-next';
import { ref } from 'vue';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from './ui/collapsible';
import {
    SidebarGroup,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from './ui/sidebar';

const page = usePage<SharedData>();

defineProps<{
    items: NavItem[];
}>();

const requiredPermissions = new Set<PermissionKey>(['view.user', 'create.user']);

const open = ref(true);

const visible = page.props.auth.permissions.some((permission) => {
    return requiredPermissions.has(permission);
});
</script>

<template>
    <SidebarGroup v-if="visible">
        <SidebarMenu>
            <Collapsible :default-open="open" as-child class="group/collapsible">
                <SidebarMenuItem>
                    <CollapsibleTrigger as-child>
                        <SidebarMenuButton tooltip="Manajemen Pengguna">
                            <UserCog />
                            <span>Manajemen Pengguna</span>
                            <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                        </SidebarMenuButton>
                    </CollapsibleTrigger>
                    <CollapsibleContent>
                        <SidebarMenuSub>
                            <SidebarMenuSubItem v-for="item in items" :key="item.title">
                                <SidebarMenuSubButton as-child>
                                    <Link :href="item.href">
                                        <span>{{ item.title }}</span>
                                    </Link>
                                </SidebarMenuSubButton>
                            </SidebarMenuSubItem>
                        </SidebarMenuSub>
                    </CollapsibleContent>
                </SidebarMenuItem>
            </Collapsible>
        </SidebarMenu>
    </SidebarGroup>
</template>
