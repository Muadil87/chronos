<nav x-data="{ mobileMenuOpen: false }" class="bg-black/50 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center gap-3">
                    <img src="{{ asset('logo.png') }}" alt="Chronos Logo" class="block h-12 w-auto object-contain" />
                    <span class="text-xl font-bold tracking-tight text-white select-none">
                        Chronos
                    </span>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-2">
                
                <a href="{{ url('/stats') }}" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all group relative" title="Analytics">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="absolute top-full mt-2 left-1/2 -translate-x-1/2 text-[10px] bg-gray-900 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Stats</span>
                </a>

                <div class="h-6 w-px bg-gray-800 mx-2"></div>

                <div class="relative" x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false">
                    <button @click="open = !open" 
                            class="flex items-center gap-2 px-4 py-2 border border-gray-700 rounded-full text-sm font-medium text-gray-300 bg-gray-900/50 hover:text-white hover:bg-gray-800 hover:border-indigo-500/50 transition-all focus:outline-none">
                        <div class="w-5 h-5 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="hidden md:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" 
                         x-cloak
                         style="display: none;"
                         class="absolute right-0 mt-3 w-56 rounded-xl shadow-xl bg-gray-900 border border-gray-800 overflow-hidden z-50"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">
                        
                        <div class="px-4 py-3 border-b border-gray-800 bg-gray-800/50">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Edit Profile
                            </a>
                        </div>

                        <div class="border-t border-gray-800 py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" class="hidden sm:hidden bg-black/95 backdrop-blur-xl border-b border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-indigo-500 text-base font-medium text-white bg-indigo-900/20">Dashboard</a>
            <a href="{{ url('/stats') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition duration-150">Analytics</a>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-400 hover:text-white transition duration-150">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-red-400 hover:text-red-300 hover:bg-gray-800 transition duration-150">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>