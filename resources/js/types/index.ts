import type { LucideIcon } from 'lucide-vue-next';
import { PermissionKey } from './authorization/permission';

export interface Auth {
    user: User;
    permissions: string[]
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    permission?: PermissionKey,
}

export interface SharedData {
    [key: string]: unknown
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: {
        location: string;
        url: string;
        port: null | number;
        defaults: Record<string, unknown>;
        routes: Record<string, string>;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type Role = {
    id: number,
    name: string,
    permissions: Permission[]
}

export type Permission = {
    id: number,
    name: string
}

export type Pagination<T> = {
  data: T[]
  current_page: number
  last_page: number
  per_page: number
  total: number
  from: number | null
  to: number | null
  first_page_url: string | null
  last_page_url: string | null
  next_page_url: string | null
  prev_page_url: string | null
  path: string
  links: {
    url: string | null
    label: string
    active: boolean
  }[]
}

export type BreadcrumbItemType = BreadcrumbItem;
