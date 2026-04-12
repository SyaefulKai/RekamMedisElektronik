<script setup lang="ts">
import { NavItem, SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';
import { ref } from 'vue';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from './ui/collapsible';
import { SidebarGroup, SidebarGroupContent, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from './ui/sidebar';

const page = usePage<SharedData>();

const props = defineProps<{
    items: NavItem[];
}>();

const open = ref(props.items.find(item => item.href == page.url) != undefined);
</script>

<template>
    <SidebarGroup as-child class="border">
        <Collapsible :default-open="open" class="group/collapsible">
            <SidebarGroupLabel as-child>
                <CollapsibleTrigger
                    class="group/label w-full text-left text-sm text-sidebar-foreground hover:text-sidebar-accent-foreground [&[data-state=open]>svg]:rotate-90"
                    :class="{
                        'hover:bg-sidebar-accent': !open,
                        'hover:none': open,
                    }"
                >
                    Manajemen User
                    <ChevronRight class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-90" />
                </CollapsibleTrigger>
            </SidebarGroupLabel>
            <CollapsibleContent>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <SidebarMenuItem v-for="item in items" :key="item.title">
                            <SidebarMenuButton as-child :is-active="item.href === page.url">
                                <Link :href="item.href">
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroupContent>
            </CollapsibleContent>
        </Collapsible>
    </SidebarGroup>
</template>
