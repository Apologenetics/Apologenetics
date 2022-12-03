<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @livewireStyles
    </head>
    <body class="font-sans antialiased w-full h-screen bg-slate-100">
        <!-- Sidebar and Content -->
        <div class="flex flex-row h-full">
            <!-- Sidebar -->
            <div class="h-full flex flex-col p-4 w-fit overflow-y-auto position-fixed items-center justify-between bg-white"
                id="sidebar" x-transition x-data="{
                    open: false,
                    opendSubMenu: false,
                    subMenuOpen: {
                        users: false,
                        groups: false,
                        doctrines: false,
                        nuggets: false
                    },
                    openMenu() {
                        for (let text of document.getElementsByClassName('icon-name')) {
                            text.style.display = this.open ? 'none' : 'block';
                        }

                        for (let chev of document.getElementsByClassName('menu-extend')) {
                            chev.style.display = this.open ? 'none' : 'block';
                        }

                        this.open ? $el.removeAttribute('style') : $el.setAttribute('style', 'width: 16rem !important');

                        if (this.openedSubMenu) {
                            this.actionSubMenu(false);
                        }

                        this.open = !this.open;
                    },
                    actionSubMenu(open) {
                        for (let menu in this.subMenuOpen) {
                            this.subMenuOpen[menu] = open;
                        }
                    },
                    openSubMenu(name) {
                        if (!this.open) {
                            this.openMenu();
                        }

                        this.subMenuOpen[name] = !this.subMenuOpen[name];
                        this.openedSubMenu = this.checkOpened();
                    },
                    checkOpened() {
                        for (let menu in this.subMenuOpen) {
                            if (this.subMenuOpen[menu]) {
                                return true;
                            }
                        }

                        return false;
                    }
                }">
                <!-- Main Sidebar Content -->
                <div class="flex flex-col w-full">
                    <div class="w-full">
                        <div class="rounded-full w-10 h-10 bg-gray-500"></div>
                    </div>
                    <!-- Hamburger Menu -->
                    <div class="w-full pt-8 pl-2" x-on:click="openMenu()">
                        <svg class="h-6 w-6 text-slate-500 hover:cursor-pointer" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 7H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M3 17H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="w-full flex flex-col space-y-6 pt-8">
                        <!-- Home -->
                        <a href="{{ route('dashboard') }}">
                            <x-menu-icon :isSelected="request()->is('dashboard')" :singleItem="true">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 18V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="font-semibold icon-name" style="display: none;">Home</p>
                            </x-menu-icon>
                        </a>
                        <!-- Users -->
                        <x-menu-icon :isSelected="request()->is('users*')" x-on:click="openSubMenu('users')">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.9699 14.44C18.3399 14.67 19.8499 14.43 20.9099 13.72C22.3199 12.78 22.3199 11.24 20.9099 10.3C19.8399 9.59004 18.3099 9.35003 16.9399 9.59003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.96998 7.16C6.02998 7.15 6.09998 7.15 6.15998 7.16C7.53998 7.11 8.63998 5.98 8.63998 4.58C8.63998 3.15 7.48998 2 6.05998 2C4.62998 2 3.47998 3.16 3.47998 4.58C3.48998 5.98 4.58998 7.11 5.96998 7.16Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.99994 14.44C5.62994 14.67 4.11994 14.43 3.05994 13.72C1.64994 12.78 1.64994 11.24 3.05994 10.3C4.12994 9.59004 5.65994 9.35003 7.02994 9.59003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.32996 13.45 9.32996 12.05C9.32996 10.62 10.48 9.46997 11.91 9.46997C13.34 9.46997 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.08997 17.78C7.67997 18.72 7.67997 20.26 9.08997 21.2C10.69 22.27 13.31 22.27 14.91 21.2C16.32 20.26 16.32 18.72 14.91 17.78C13.32 16.72 10.69 16.72 9.08997 17.78Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Users</p>
                            <x-slot:children x-show="subMenuOpen.users">
                                <x-submenu-link :active="request()->is(route('users.index'))" url="{{ route('users.index') }}">View Users</x-submenu-link>
                                <x-submenu-link :active="request()->is(route('users.edit'))" url="{{ route('users.edit') }}">Edit User</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Religions/Denominations -->
                        <x-menu-icon :isSelected="request()->is('religions*') || request()->is('denominations*')" x-on:click="openSubMenu('groups')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Religions</p>
                            <x-slot:children x-show="subMenuOpen.groups">
                                <x-submenu-link :active="request()->routeIs('religions.list')" url="{{ route('religions.list') }}">Show Religions</x-submenu-link>
                                <x-submenu-link :active="request()->routeIs('religions.create')" url="{{ route('religions.create') }}">Create Religions</x-submenu-link>
                                <x-submenu-link :active="request()->routeIs('denominations.create')" url="{{ route('denominations.create') }}">Create Denomination</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Doctrines -->
                        <x-menu-icon :isSelected="request()->is('doctrines*')" x-on:click="openSubMenu('doctrines')">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.7399V4.66994C22 3.46994 21.02 2.57994 19.83 2.67994H19.77C17.67 2.85994 14.48 3.92994 12.7 5.04994L12.53 5.15994C12.24 5.33994 11.76 5.33994 11.47 5.15994L11.22 5.00994C9.44 3.89994 6.26 2.83994 4.16 2.66994C2.97 2.56994 2 3.46994 2 4.65994V16.7399C2 17.6999 2.78 18.5999 3.74 18.7199L4.03 18.7599C6.2 19.0499 9.55 20.1499 11.47 21.1999L11.51 21.2199C11.78 21.3699 12.21 21.3699 12.47 21.2199C14.39 20.1599 17.75 19.0499 19.93 18.7599L20.26 18.7199C21.22 18.5999 22 17.6999 22 16.7399Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 5.48999V20.49" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.75 8.48999H5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.5 11.49H5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Doctrines</p>
                            <x-slot:children x-show="subMenuOpen.doctrines">
                                <x-submenu-link :active="request()->is(route('doctrines.list'))" url="{{ route('doctrines.list') }}">Show Doctrines</x-submenu-link>
                                <x-submenu-link :active="request()->is(route('doctrines.create'))" url="{{ route('doctrines.create') }}">Create Doctrine</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Nuggets -->
                        <x-menu-icon :isSelected="request()->is('nuggets*')" x-on:click="openSubMenu('nuggets')">
                            <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                            <p class="font-semibold icon-name" style="display: none;">Nuggets</p>
                            <x-slot:children x-show="subMenuOpen.nuggets">
                                <x-submenu-link :active="request()->is(route('nuggets.list'))" url="{{ route('nuggets.list') }}">Show Nuggets</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                    </div>
                </div>

                <!-- Profile -->
                <div class="items-center flex flex-row justify-between w-full">
                    <div class="flex flex-row space-x-4 items-center">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->username }}"
                             class="w-8 h-8 rounded-full hover:cursor-pointer" x-on:click="openMenu" />
                        <div class="icon-name flex flex-col space-y-2" style="display: none;">
                            <span class="text-md font-semibold">{{ auth()->user()->username }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header & Content -->
            <div class="w-full overflow-y-auto h-full">
                <!-- Header Bar -->
                <div class="flex flex-row justify-center items-center w-full pt-2 px-6" style="height: 10%;">
                    <livewire:search />
                </div>
                <div class="w-full" style="height: 90%;">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @livewire('livewire-ui-modal')
    </body>
</html>
