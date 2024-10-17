<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="manifest" href="manifest.json" />
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
</head>

<body class="font-sans antialiased w-full h-screen bg-slate-100 dark:bg-gray-900">
    <!-- Sidebar and Content -->
    <div class="flex flex-row h-full justify-start items-start" x-data="{
        open: false,
        mobileOpen: false,
        opendSubMenu: false,
        subMenuOpen: {
            users: false,
            groups: false,
            doctrines: false,
            nuggets: false
        },
        isOpen() {
            return this.open || this.mobileOpen;
        },
        openMobile() {
            this.mobileOpen = !this.mobileOpen;
    
            for (let text of document.getElementsByClassName('icon-name')) {
                text.style.display = this.mobileOepn ? 'none' : 'block';
            }
    
            for (let chev of document.getElementsByClassName('menu-extend')) {
                chev.style.display = this.mobileOepn ? 'none' : 'block';
            }
    
            if (this.openedSubMenu) {
                this.actionSubMenu(false);
            }
        },
        openMainMenu() {
            if (this.mobileOpen) {
                this.mobileOpen = false;
            }
    
            for (let text of document.getElementsByClassName('icon-name')) {
                text.style.display = this.open ? 'none' : 'block';
            }
    
            for (let chev of document.getElementsByClassName('menu-extend')) {
                chev.style.display = this.open ? 'none' : 'block';
            }
    
            if (this.openedSubMenu) {
                this.actionSubMenu(false);
            }
    
            this.open = !this.open;
        },
        openMenu() {
            this.mobileOpen ? this.openMobile() : this.openMainMenu();
        },
        actionSubMenu(open) {
            for (let menu in this.subMenuOpen) {
                this.subMenuOpen[menu] = open;
            }
        },
        openSubMenu(name) {
            this.subMenuOpen[name] = !this.subMenuOpen[name];
            this.openedSubMenu = this.checkOpened();
    
            if (!this.isOpen()) {
                this.openMenu();
            }
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
        <!-- Sidebar -->
        <div id="sidebar" x-transition
            :class="mobileOpen ? 'h-full m-0 flex flex-col w-fit lg:w-16 bg-white dark:bg-gray-700' :
                'h-full m-0 hidden lg:flex flex-col w-fit lg:w-16 bg-white dark:bg-gray-700'">

            <div popover id="sidebar-expanded"
                class="m-0 p-4 h-full w-fit flex flex-col overflow-y-auto items-center justify-between border-r border-gray-200 dark:border-gray-700 isolate z-10 dark:bg-gray-900">
                <!-- Main Sidebar Content -->
                <div class="flex flex-col w-full items-center" x-cloak>
                    <div class="flex flex-col-reverse md:flex-col w-full items-center">
                        <!-- Logo & Name -->
                        <div class="w-full flex flex-row space-x-4 items-center md:justify-normal">
                            <div class="hidden md:flex w-10 h-10">
                                <svg viewBox="0 0 185.0822 178.14806" version="1.1" id="svg4737" class="text-sky-900"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                    <defs id="defs4734" />
                                    <g id="layer1" fill="currentColor" transform="translate(-17.70363,-14.215199)">
                                        <path fill="curentColor"
                                            style="display:inline;stroke:none;stroke-width:2.065;stroke-dasharray:none;stroke-opacity:1"
                                            d="m 32.282524,192.0033 c 0,-0.29803 4.546613,-15.04051 8.466298,-27.45215 0.850197,-2.69214 2.039446,-6.50214 2.642778,-8.46667 0.603329,-1.96453 2.156743,-6.96515 3.452029,-11.1125 1.771578,-5.67238 7.051259,-22.85469 8.876974,-28.88943 0.125254,-0.41401 -0.790808,-0.45344 -12.511359,-0.53851 -12.17984,-0.0884 -12.709975,-0.11315 -14.366303,-0.67075 -11.50307,-3.87248 -14.84068,-16.918134 -6.488152,-25.360114 4.306503,-4.35262 4.215624,-4.33703 25.278087,-4.33703 h 16.911803 l 0.688183,-2.3151 c 0.37851,-1.27331 1.15624,-3.84671 1.7283,-5.71866 0.57206,-1.87196 1.04011,-3.5639 1.04011,-3.75987 0,-0.2944 -3.114336,-0.37008 -17.92552,-0.43555 -21.105465,-0.0933 -20.536809,-0.01 -25.431418,-3.735668 -9.919316,-7.550858 -6.171541,-23.079068 6.47196,-26.815371 1.421667,-0.420118 3.567956,-0.469701 23.719754,-0.547981 l 22.156654,-0.08606 0.1599,-0.716303 c 0.74044,-3.316775 3.22012,-10.812206 4.09823,-12.387863 0.25246,-0.453006 0.61732,-1.10785 0.81082,-1.455208 9.80772,-17.6069138 35.351138,-17.2327698 43.856878,0.642384 1.02896,2.1624 6.96739,20.002285 9.04377,27.16876 l 0.57494,1.984375 h 26.09399 c 29.22655,0 27.71746,-0.09169 31.75325,1.929272 11.89458,5.956325 12.69085,23.806883 1.31146,29.400093 -3.32,1.63184 -2.97334,1.61125 -27.12346,1.61125 -19.56706,0 -22.0825,0.0459 -22.22033,0.40505 -0.13494,0.35164 3.45183,12.666634 3.90072,13.392964 0.11288,0.18264 0.49972,0.17707 1.19565,-0.0172 6.70694,-1.87234 14.68678,1.09464 18.07412,6.72014 5.62944,9.34905 1.1295,21.28911 -8.72794,23.15853 -0.7808,0.14808 -1.50405,0.35676 -1.60722,0.46373 -0.10317,0.10698 0.88016,3.58779 2.18518,7.73513 1.30503,4.14735 4.45882,14.20813 7.00843,22.35729 2.54961,8.14917 5.1171,16.30495 5.70553,18.12396 1.20562,3.72693 2.86465,9.27888 2.86465,9.58655 0,0.11166 -4.61982,0.20302 -10.26627,0.20302 h -10.26627 l -1.2588,-4.16718 c -0.69234,-2.29196 -1.56067,-5.12998 -1.92962,-6.30672 l -0.67082,-2.13953 -47.5141,0.0229 -47.514109,0.0229 -1.876764,6.08541 c -1.032219,3.34698 -1.970841,6.23425 -2.085826,6.41615 -0.303978,0.48089 -20.286167,0.48249 -20.286167,0.002 z M 146.05198,162.10375 c -0.005,-0.22035 -2.07612,-6.85394 -2.15319,-6.89501 -0.0519,-0.0277 -18.03579,-0.0165 -39.96416,0.0248 l -39.869762,0.0751 -0.41124,1.38011 c -0.226181,0.75906 -0.700489,2.30285 -1.05402,3.43064 l -0.642784,2.05052 h 42.048266 c 23.12655,0 42.04765,-0.0298 42.04689,-0.0661 z m -41.64886,-23.48177 c 32.43539,0 34.24184,-0.0244 34.24073,-0.46302 -5.3e-4,-0.25466 -0.40285,-1.77271 -0.89379,-3.37344 l -0.89261,-2.91041 -32.69948,-0.0672 -32.699468,-0.0672 -0.68359,2.31614 c -0.37597,1.27388 -0.85619,2.79637 -1.06715,3.38332 -0.48618,1.35267 -0.48129,1.54048 0.0349,1.34238 0.23018,-0.0883 15.82737,-0.1606 34.660418,-0.1606 z m 53.73965,-14.94929 c 6.37155,-1.89215 4.09305,-9.76571 -2.69671,-9.31871 -3.4316,0.22591 -3.27466,-0.22647 -1.71845,4.95342 0.41533,1.38245 0.88719,3.01956 1.04856,3.63802 0.34106,1.30709 0.96225,1.44129 3.3666,0.72727 z m -26.64149,-8.87236 c 0,-0.0778 -0.48096,-1.65227 -1.06878,-3.49883 l -1.06877,-3.35739 -25.23449,0.0593 -25.234498,0.0592 -0.98689,3.175 c -0.54279,1.74625 -1.0306,3.29406 -1.08402,3.43958 -0.0643,0.17531 9.14362,0.26459 27.290178,0.26459 15.06301,0 27.38728,-0.0636 27.38727,-0.14145 z M 50.803356,101.033 v -5.008934 h -2.513541 -2.513542 l -5.29e-4,5.093234 -5.29e-4,5.09323 2.514134,-0.0843 2.514134,-0.0843 v -5.00892 z m -14.678929,3.86541 c 4.18892,-2.45488 2.841157,-8.781634 -2.039435,-9.573644 -3.190472,-0.51774 -6.451171,2.77032 -5.879403,5.928744 0.707099,3.90595 4.496858,5.65031 7.918838,3.6449 z M 123.82973,90.600106 c 0.001,-0.14552 -0.43287,-1.7231 -0.96488,-3.50573 l -0.9673,-3.24114 H 104.11846 86.339362 l -0.70157,2.3151 c -0.38587,1.27331 -0.87026,2.86543 -1.07642,3.53805 l -0.37485,1.22295 19.820398,-0.0323 c 13.01385,-0.0212 19.82122,-0.12319 19.82281,-0.29691 z m 26.36491,-16.27214 0.0402,-6.085148 h -2.75222 -2.75222 v 6.085418 6.08541 l 2.71198,-2.6e-4 2.71198,-2.7e-4 0.0402,-6.08514 z m 12.79205,2.7e-4 v -6.085418 h -2.77813 -2.77812 v 6.085418 6.08541 h 2.77812 2.77813 z m 12.7,0 v -6.085418 h -2.77813 -2.77812 v 6.085418 6.08541 h 2.77812 2.77813 z m 13.52041,4.72596 c 4.70528,-1.57539 4.81962,-7.66875 0.18027,-9.606718 -1.83019,-0.76451 -3.41343,-0.44549 -4.93484,0.99438 -3.81526,3.610778 -0.14791,10.253748 4.75457,8.612338 z M 115.8222,63.943339 c -0.0689,-0.181901 -0.52683,-1.729714 -1.01763,-3.439583 l -0.89238,-3.108854 h -9.71698 c -8.987308,0 -9.734848,0.03477 -9.954778,0.46302 -0.22042,0.429218 -1.8975,5.981338 -1.8975,6.281859 0,0.07386 5.31103,0.134287 11.802278,0.134287 9.33223,0 11.77604,-0.06922 11.67699,-0.330729 z m -65.00359,-3.175 c 0.0084,-1.491588 0.02225,-3.783541 0.03081,-5.093229 0.0085,-1.309687 0.0016,-2.589609 -0.01527,-2.844271 -0.02702,-0.406318 -0.338617,-0.46302 -2.544339,-0.46302 h -2.513542 v 5.556249 5.55625 h 2.513542 2.513541 l 0.01527,-2.711979 z m 12.684746,-2.976562 v -5.688542 h -2.513542 -2.513541 v 5.688542 5.688541 h 2.513541 2.513542 z m -27.257337,4.564062 c 4.003347,-2.045343 3.816456,-7.320785 -0.320588,-9.04935 -3.411595,-1.425456 -7.158084,1.101151 -7.158084,4.827367 0,3.597408 4.13363,5.930993 7.478672,4.221983 z m 73.294841,-19.14281 c 0,-1.878057 -2.20128,-7.147377 -3.254,-7.789253 -2.97833,-1.815997 -5.52361,-0.144381 -6.801538,4.466931 -0.96256,3.473294 -0.96368,3.469372 0.776938,2.720575 2.5128,-1.080976 7.57639,-0.759746 8.37427,0.531262 0.15957,0.258181 0.90433,0.31623 0.90433,0.07048 z"
                                            id="path4680" />
                                    </g>
                                </svg>
                            </div>
                            <div x-show="isOpen()">
                                <h3 class="text-xl text-sky-900 font-semibold">{{ env('APP_NAME') }}</h3>
                            </div>
                        </div>

                        <!-- Hamburger Menu -->
                        <div class="w-fit md:w-full md:pt-8 md:pl-2 hover:cursor-pointer" x-on:click="openMenu()">
                            <svg class="h-6 w-6 text-slate-500 hover:cursor-pointer" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 7H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M3 17H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>

                    <!-- Other Menu Items -->
                    <div
                        :class="{
                            'w-full flex flex-col space-y-6 pt-8': isOpen(),
                            'hidden w-full md:flex flex-col space-y-6 pt-8': !isOpen()
                        }">
                        <!-- Home -->
                        <a href="{{ route('dashboard') }}">
                            <x-menu-icon x-cloak :isSelected="request()->is('dashboard')" :singleItem="true">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 18V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <p class="font-semibold icon-name" style="display: none;">Home</p>
                            </x-menu-icon>
                        </a>
                        <!-- Users -->
                        <x-menu-icon x-cloak :isSelected="request()->is('users*')" x-on:click="openSubMenu('users')">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M16.9699 14.44C18.3399 14.67 19.8499 14.43 20.9099 13.72C22.3199 12.78 22.3199 11.24 20.9099 10.3C19.8399 9.59004 18.3099 9.35003 16.9399 9.59003"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M5.96998 7.16C6.02998 7.15 6.09998 7.15 6.15998 7.16C7.53998 7.11 8.63998 5.98 8.63998 4.58C8.63998 3.15 7.48998 2 6.05998 2C4.62998 2 3.47998 3.16 3.47998 4.58C3.48998 5.98 4.58998 7.11 5.96998 7.16Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M6.99994 14.44C5.62994 14.67 4.11994 14.43 3.05994 13.72C1.64994 12.78 1.64994 11.24 3.05994 10.3C4.12994 9.59004 5.65994 9.35003 7.02994 9.59003"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.32996 13.45 9.32996 12.05C9.32996 10.62 10.48 9.46997 11.91 9.46997C13.34 9.46997 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M9.08997 17.78C7.67997 18.72 7.67997 20.26 9.08997 21.2C10.69 22.27 13.31 22.27 14.91 21.2C16.32 20.26 16.32 18.72 14.91 17.78C13.32 16.72 10.69 16.72 9.08997 17.78Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Users</p>
                            <x-slot:children x-show="isOpen() && subMenuOpen.users">
                                <x-submenu-link :active="request()->is(route('users.index'))" url="{{ route('users.index') }}">View
                                    Users</x-submenu-link>
                                <x-submenu-link :active="request()->is(route('users.edit'))" url="{{ route('users.edit') }}">Edit
                                    User</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Religions/Denominations -->
                        <x-menu-icon x-cloak :isSelected="request()->is('religions*') || request()->is('denominations*')" x-on:click="openSubMenu('groups')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Religions</p>
                            <x-slot:children x-show="isOpen() && subMenuOpen.groups">
                                <x-submenu-link :active="request()->routeIs('religions.list')" url="{{ route('religions.list') }}">Show
                                    Religions</x-submenu-link>
                                <x-submenu-link :active="request()->routeIs('religions.create')" url="{{ route('religions.create') }}">Create
                                    Religions</x-submenu-link>
                                <x-submenu-link :active="request()->routeIs('denominations.create')" url="{{ route('denominations.create') }}">Create
                                    Denomination</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Doctrines -->
                        <x-menu-icon x-cloak :isSelected="request()->is('doctrines*')" x-on:click="openSubMenu('doctrines')">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 16.7399V4.66994C22 3.46994 21.02 2.57994 19.83 2.67994H19.77C17.67 2.85994 14.48 3.92994 12.7 5.04994L12.53 5.15994C12.24 5.33994 11.76 5.33994 11.47 5.15994L11.22 5.00994C9.44 3.89994 6.26 2.83994 4.16 2.66994C2.97 2.56994 2 3.46994 2 4.65994V16.7399C2 17.6999 2.78 18.5999 3.74 18.7199L4.03 18.7599C6.2 19.0499 9.55 20.1499 11.47 21.1999L11.51 21.2199C11.78 21.3699 12.21 21.3699 12.47 21.2199C14.39 20.1599 17.75 19.0499 19.93 18.7599L20.26 18.7199C21.22 18.5999 22 17.6999 22 16.7399Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 5.48999V20.49" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.75 8.48999H5.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.5 11.49H5.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="font-semibold icon-name" style="display: none;">Doctrines</p>
                            <x-slot:children x-show="isOpen() && subMenuOpen.doctrines">
                                <x-submenu-link :active="request()->is(route('doctrines.list'))" url="{{ route('doctrines.list') }}">Show
                                    Doctrines</x-submenu-link>
                                <x-submenu-link :active="request()->is(route('doctrines.create'))" url="{{ route('doctrines.create') }}">Create
                                    Doctrine</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                        <!-- Nuggets -->
                        <x-menu-icon x-cloak :isSelected="request()->is('nuggets*')" x-on:click="openSubMenu('nuggets')">
                            <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                            <p class="font-semibold icon-name" style="display: none;">Nuggets</p>
                            <x-slot:children x-show="isOpen() && subMenuOpen.nuggets">
                                <x-submenu-link :active="request()->is(route('nuggets.list'))" url="{{ route('nuggets.list') }}">Show
                                    Nuggets</x-submenu-link>
                            </x-slot:children>
                        </x-menu-icon>
                    </div>
                </div>

                <!-- Profile -->
                {{-- TODO: Add settings and logout icon in expanded view. Maybe with labels? --}}
                <div class="items-center flex flex-row justify-between w-full">
                    <div class="flex flex-row items-center">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->username }}"
                            class="size-8 dark:text-white rounded-full hover:cursor-pointer" x-on:click="openMenu" />
                        <div class="icon-name flex flex-col space-y-2 ml-4 w-full" x-show="open">
                            <span class="text-md font-semibold text-center">{{ auth()->user()->username }}</span>
                            <!-- Icons -->
                            <div class="w-full justify-center items-center flex flex-row space-x-4">
                                <!-- Logout -->
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.4409 15.3699C17.2509 15.3699 17.0609 15.2999 16.9109 15.1499C16.6209 14.8599 16.6209 14.3799 16.9109 14.0899L18.9409 12.0599L16.9109 10.0299C16.6209 9.73994 16.6209 9.25994 16.9109 8.96994C17.2009 8.67994 17.6809 8.67994 17.9709 8.96994L20.5309 11.5299C20.8209 11.8199 20.8209 12.2999 20.5309 12.5899L17.9709 15.1499C17.8209 15.2999 17.6309 15.3699 17.4409 15.3699Z"
                                                fill="currentColor" />
                                            <path
                                                d="M19.9298 12.8101H9.75977C9.34977 12.8101 9.00977 12.4701 9.00977 12.0601C9.00977 11.6501 9.34977 11.3101 9.75977 11.3101H19.9298C20.3398 11.3101 20.6798 11.6501 20.6798 12.0601C20.6798 12.4701 20.3398 12.8101 19.9298 12.8101Z"
                                                fill="currentColor" />
                                            <path
                                                d="M11.7598 20.75C6.60977 20.75 3.00977 17.15 3.00977 12C3.00977 6.85 6.60977 3.25 11.7598 3.25C12.1698 3.25 12.5098 3.59 12.5098 4C12.5098 4.41 12.1698 4.75 11.7598 4.75C7.48977 4.75 4.50977 7.73 4.50977 12C4.50977 16.27 7.48977 19.25 11.7598 19.25C12.1698 19.25 12.5098 19.59 12.5098 20C12.5098 20.41 12.1698 20.75 11.7598 20.75Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                </form>
                                <!-- Settings -->
                                <a href="/user/profile" class="text-gray-500">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 15.75C9.93 15.75 8.25 14.07 8.25 12C8.25 9.93 9.93 8.25 12 8.25C14.07 8.25 15.75 9.93 15.75 12C15.75 14.07 14.07 15.75 12 15.75ZM12 9.75C10.76 9.75 9.75 10.76 9.75 12C9.75 13.24 10.76 14.25 12 14.25C13.24 14.25 14.25 13.24 14.25 12C14.25 10.76 13.24 9.75 12 9.75Z"
                                            fill="currentColor" />
                                        <path
                                            d="M15.21 22.1898C15 22.1898 14.79 22.1598 14.58 22.1098C13.96 21.9398 13.44 21.5498 13.11 20.9998L12.99 20.7998C12.4 19.7798 11.59 19.7798 11 20.7998L10.89 20.9898C10.56 21.5498 10.04 21.9498 9.42 22.1098C8.79 22.2798 8.14 22.1898 7.59 21.8598L5.87 20.8698C5.26 20.5198 4.82 19.9498 4.63 19.2598C4.45 18.5698 4.54 17.8598 4.89 17.2498C5.18 16.7398 5.26 16.2798 5.09 15.9898C4.92 15.6998 4.49 15.5298 3.9 15.5298C2.44 15.5298 1.25 14.3398 1.25 12.8798V11.1198C1.25 9.6598 2.44 8.4698 3.9 8.4698C4.49 8.4698 4.92 8.2998 5.09 8.0098C5.26 7.7198 5.19 7.2598 4.89 6.7498C4.54 6.1398 4.45 5.4198 4.63 4.7398C4.81 4.0498 5.25 3.4798 5.87 3.1298L7.6 2.1398C8.73 1.4698 10.22 1.8598 10.9 3.0098L11.02 3.2098C11.61 4.2298 12.42 4.2298 13.01 3.2098L13.12 3.0198C13.8 1.8598 15.29 1.4698 16.43 2.1498L18.15 3.1398C18.76 3.4898 19.2 4.0598 19.39 4.7498C19.57 5.4398 19.48 6.1498 19.13 6.7598C18.84 7.2698 18.76 7.7298 18.93 8.0198C19.1 8.3098 19.53 8.4798 20.12 8.4798C21.58 8.4798 22.77 9.6698 22.77 11.1298V12.8898C22.77 14.3498 21.58 15.5398 20.12 15.5398C19.53 15.5398 19.1 15.7098 18.93 15.9998C18.76 16.2898 18.83 16.7498 19.13 17.2598C19.48 17.8698 19.58 18.5898 19.39 19.2698C19.21 19.9598 18.77 20.5298 18.15 20.8798L16.42 21.8698C16.04 22.0798 15.63 22.1898 15.21 22.1898ZM12 18.4898C12.89 18.4898 13.72 19.0498 14.29 20.0398L14.4 20.2298C14.52 20.4398 14.72 20.5898 14.96 20.6498C15.2 20.7098 15.44 20.6798 15.64 20.5598L17.37 19.5598C17.63 19.4098 17.83 19.1598 17.91 18.8598C17.99 18.5598 17.95 18.2498 17.8 17.9898C17.23 17.0098 17.16 15.9998 17.6 15.2298C18.04 14.4598 18.95 14.0198 20.09 14.0198C20.73 14.0198 21.24 13.5098 21.24 12.8698V11.1098C21.24 10.4798 20.73 9.9598 20.09 9.9598C18.95 9.9598 18.04 9.5198 17.6 8.7498C17.16 7.9798 17.23 6.9698 17.8 5.9898C17.95 5.7298 17.99 5.4198 17.91 5.1198C17.83 4.8198 17.64 4.5798 17.38 4.4198L15.65 3.4298C15.22 3.1698 14.65 3.3198 14.39 3.7598L14.28 3.9498C13.71 4.9398 12.88 5.4998 11.99 5.4998C11.1 5.4998 10.27 4.9398 9.7 3.9498L9.59 3.7498C9.34 3.3298 8.78 3.1798 8.35 3.4298L6.62 4.4298C6.36 4.5798 6.16 4.8298 6.08 5.1298C6 5.4298 6.04 5.7398 6.19 5.9998C6.76 6.9798 6.83 7.9898 6.39 8.7598C5.95 9.5298 5.04 9.9698 3.9 9.9698C3.26 9.9698 2.75 10.4798 2.75 11.1198V12.8798C2.75 13.5098 3.26 14.0298 3.9 14.0298C5.04 14.0298 5.95 14.4698 6.39 15.2398C6.83 16.0098 6.76 17.0198 6.19 17.9998C6.04 18.2598 6 18.5698 6.08 18.8698C6.16 19.1698 6.35 19.4098 6.61 19.5698L8.34 20.5598C8.55 20.6898 8.8 20.7198 9.03 20.6598C9.27 20.5998 9.47 20.4398 9.6 20.2298L9.71 20.0398C10.28 19.0598 11.11 18.4898 12 18.4898Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header & Content -->
        <div class="w-full overflow-y-auto h-full">
            <!-- Header Bar -->
            <div class="flex flex-row justify-center items-center w-full pt-2 px-6" style="height: 10%;">
                <!-- Hamburger Menu -->
                <div class="lg:hidden w-fit hover:cursor-pointer" x-on:click="openMobile()">
                    <svg class="h-6 w-6 text-slate-500 hover:cursor-pointer" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 7H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M3 17H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>

                <livewire:search />
            </div>
            <div class="w-full" style="height: 90%;">
                {{ $slot }}
            </div>
        </div>
    </div>

    @stack('modal')
</body>

</html>
