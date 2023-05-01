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
                                <x-submenu-link :active="request()->is(route('nuggets.list'))" url="{{ route('nuggets.create') }}">Create Nuggets</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                    </div>
                </div>

                <!-- Profile -->
                {{-- TODO: Add settings and logout icon in expanded view. Maybe with labels? --}}
                <div class="items-center flex flex-row justify-between w-full">
                    <div class="flex flex-row space-x-4 items-center">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->username }}"
                             class="w-8 h-8 rounded-full hover:cursor-pointer" x-on:click="openMenu" />
                        <div class="icon-name flex flex-col space-y-2 w-full" style="display: none;">
                            <span class="text-md font-semibold text-center">{{ auth()->user()->username }}</span>
                            <!-- Icons -->
                            <div class="w-full justify-center items-center flex flex-row space-x-4">
                                <!-- Logout -->
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.4409 15.3699C17.2509 15.3699 17.0609 15.2999 16.9109 15.1499C16.6209 14.8599 16.6209 14.3799 16.9109 14.0899L18.9409 12.0599L16.9109 10.0299C16.6209 9.73994 16.6209 9.25994 16.9109 8.96994C17.2009 8.67994 17.6809 8.67994 17.9709 8.96994L20.5309 11.5299C20.8209 11.8199 20.8209 12.2999 20.5309 12.5899L17.9709 15.1499C17.8209 15.2999 17.6309 15.3699 17.4409 15.3699Z" fill="currentColor"/>
                                            <path d="M19.9298 12.8101H9.75977C9.34977 12.8101 9.00977 12.4701 9.00977 12.0601C9.00977 11.6501 9.34977 11.3101 9.75977 11.3101H19.9298C20.3398 11.3101 20.6798 11.6501 20.6798 12.0601C20.6798 12.4701 20.3398 12.8101 19.9298 12.8101Z" fill="currentColor"/>
                                            <path d="M11.7598 20.75C6.60977 20.75 3.00977 17.15 3.00977 12C3.00977 6.85 6.60977 3.25 11.7598 3.25C12.1698 3.25 12.5098 3.59 12.5098 4C12.5098 4.41 12.1698 4.75 11.7598 4.75C7.48977 4.75 4.50977 7.73 4.50977 12C4.50977 16.27 7.48977 19.25 11.7598 19.25C12.1698 19.25 12.5098 19.59 12.5098 20C12.5098 20.41 12.1698 20.75 11.7598 20.75Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                </form>
                                <!-- Settings -->
                                <a href="/user/profile" class="text-gray-500">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15.75C9.93 15.75 8.25 14.07 8.25 12C8.25 9.93 9.93 8.25 12 8.25C14.07 8.25 15.75 9.93 15.75 12C15.75 14.07 14.07 15.75 12 15.75ZM12 9.75C10.76 9.75 9.75 10.76 9.75 12C9.75 13.24 10.76 14.25 12 14.25C13.24 14.25 14.25 13.24 14.25 12C14.25 10.76 13.24 9.75 12 9.75Z" fill="currentColor"/>
                                        <path d="M15.21 22.1898C15 22.1898 14.79 22.1598 14.58 22.1098C13.96 21.9398 13.44 21.5498 13.11 20.9998L12.99 20.7998C12.4 19.7798 11.59 19.7798 11 20.7998L10.89 20.9898C10.56 21.5498 10.04 21.9498 9.42 22.1098C8.79 22.2798 8.14 22.1898 7.59 21.8598L5.87 20.8698C5.26 20.5198 4.82 19.9498 4.63 19.2598C4.45 18.5698 4.54 17.8598 4.89 17.2498C5.18 16.7398 5.26 16.2798 5.09 15.9898C4.92 15.6998 4.49 15.5298 3.9 15.5298C2.44 15.5298 1.25 14.3398 1.25 12.8798V11.1198C1.25 9.6598 2.44 8.4698 3.9 8.4698C4.49 8.4698 4.92 8.2998 5.09 8.0098C5.26 7.7198 5.19 7.2598 4.89 6.7498C4.54 6.1398 4.45 5.4198 4.63 4.7398C4.81 4.0498 5.25 3.4798 5.87 3.1298L7.6 2.1398C8.73 1.4698 10.22 1.8598 10.9 3.0098L11.02 3.2098C11.61 4.2298 12.42 4.2298 13.01 3.2098L13.12 3.0198C13.8 1.8598 15.29 1.4698 16.43 2.1498L18.15 3.1398C18.76 3.4898 19.2 4.0598 19.39 4.7498C19.57 5.4398 19.48 6.1498 19.13 6.7598C18.84 7.2698 18.76 7.7298 18.93 8.0198C19.1 8.3098 19.53 8.4798 20.12 8.4798C21.58 8.4798 22.77 9.6698 22.77 11.1298V12.8898C22.77 14.3498 21.58 15.5398 20.12 15.5398C19.53 15.5398 19.1 15.7098 18.93 15.9998C18.76 16.2898 18.83 16.7498 19.13 17.2598C19.48 17.8698 19.58 18.5898 19.39 19.2698C19.21 19.9598 18.77 20.5298 18.15 20.8798L16.42 21.8698C16.04 22.0798 15.63 22.1898 15.21 22.1898ZM12 18.4898C12.89 18.4898 13.72 19.0498 14.29 20.0398L14.4 20.2298C14.52 20.4398 14.72 20.5898 14.96 20.6498C15.2 20.7098 15.44 20.6798 15.64 20.5598L17.37 19.5598C17.63 19.4098 17.83 19.1598 17.91 18.8598C17.99 18.5598 17.95 18.2498 17.8 17.9898C17.23 17.0098 17.16 15.9998 17.6 15.2298C18.04 14.4598 18.95 14.0198 20.09 14.0198C20.73 14.0198 21.24 13.5098 21.24 12.8698V11.1098C21.24 10.4798 20.73 9.9598 20.09 9.9598C18.95 9.9598 18.04 9.5198 17.6 8.7498C17.16 7.9798 17.23 6.9698 17.8 5.9898C17.95 5.7298 17.99 5.4198 17.91 5.1198C17.83 4.8198 17.64 4.5798 17.38 4.4198L15.65 3.4298C15.22 3.1698 14.65 3.3198 14.39 3.7598L14.28 3.9498C13.71 4.9398 12.88 5.4998 11.99 5.4998C11.1 5.4998 10.27 4.9398 9.7 3.9498L9.59 3.7498C9.34 3.3298 8.78 3.1798 8.35 3.4298L6.62 4.4298C6.36 4.5798 6.16 4.8298 6.08 5.1298C6 5.4298 6.04 5.7398 6.19 5.9998C6.76 6.9798 6.83 7.9898 6.39 8.7598C5.95 9.5298 5.04 9.9698 3.9 9.9698C3.26 9.9698 2.75 10.4798 2.75 11.1198V12.8798C2.75 13.5098 3.26 14.0298 3.9 14.0298C5.04 14.0298 5.95 14.4698 6.39 15.2398C6.83 16.0098 6.76 17.0198 6.19 17.9998C6.04 18.2598 6 18.5698 6.08 18.8698C6.16 19.1698 6.35 19.4098 6.61 19.5698L8.34 20.5598C8.55 20.6898 8.8 20.7198 9.03 20.6598C9.27 20.5998 9.47 20.4398 9.6 20.2298L9.71 20.0398C10.28 19.0598 11.11 18.4898 12 18.4898Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
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
