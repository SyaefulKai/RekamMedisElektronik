<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import {
    SidebarGroup,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
    useSidebar,
} from '@/components/ui/sidebar';
import { NavItem, SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';
import { type Component, computed } from 'vue';

const props = defineProps<{
    label: string;
    icon: Component;
    items: NavItem[];
    permission?: string;
}>();

const page = usePage<SharedData>();
const { state, toggleSidebar } = useSidebar();

const userPermissions = computed<string[]>(() => page.props.auth.permissions ?? []);

const hasPermission = (permission?: string) => !permission || userPermissions.value.includes(permission);

const visibleItems = computed(() => props.items.filter((item) => hasPermission(item.permission)));

const groupVisible = computed(() => hasPermission(props.permission) && visibleItems.value.length > 0);
</script>

<template>
    <SidebarGroup v-if="groupVisible" :class="state === 'collapsed' ? 'p-0' : ''">
        <SidebarMenu>
            <Collapsible default-open class="group/collapsible">
                <SidebarMenuItem :class="{ 'flex flex-col items-center': state === 'collapsed' }">
                    <CollapsibleTrigger as-child>
                        <SidebarMenuButton :tooltip="label" @click="state === 'collapsed' ? toggleSidebar() : undefined">
                            <component :is="icon" />
                            <span>{{ label }}</span>
                            <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                        </SidebarMenuButton>
                    </CollapsibleTrigger>

                    <CollapsibleContent>
                        <SidebarMenuSub>
                            <SidebarMenuSubItem v-for="item in visibleItems" :key="item.title">
                                <SidebarMenuSubButton as-child :is-active="item.href === page.url">
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
