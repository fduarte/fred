import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
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
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
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

export interface Post {
    id: number;
    title: string;
    body: string;
    image: string;
    published: boolean;
    featured: boolean;
    tags: array;
    category_id: number;
    created_at: string;
    updated_at: string;
}

export interface News {
    id: number;
    title?: string;
    summary: string;
    source: string;
    url: string;
    published_at: string;
    author?: number;
    category: number;
    tags?: number[];
    published: boolean;
    created_at: string;
    updated_at: string;
}

export interface Favorite {
    id: number;
    title?: string;
    summary: string;
    source: string;
    url: string;
    published_at: string;
    author?: number;
    category: number;
    tags?: number[];
    published: boolean;
    created_at: string;
    updated_at: string;
}



export type BreadcrumbItemType = BreadcrumbItem;
