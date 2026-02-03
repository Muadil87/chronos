<x-app-layout>
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-indigo-900/20 rounded-full blur-[120px] opacity-50"></div>
    </div>

    <div class="py-12 relative" x-data="{ commandCenterVisible: true, searchQuery: '' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-6" x-show="commandCenterVisible && !$store.navbar.focusMode" x-transition>
                <div>
                    <h2 class="font-bold text-3xl text-white tracking-tight">
                        Command Center
                    </h2>
                    <p class="text-gray-400 mt-1">
                        Welcome back, <span class="text-indigo-400 font-mono">{{ Auth::user()->name }}</span>.
                    </p>
                </div>

                <div class="flex gap-4">
                    <div class="bg-gray-900/50 backdrop-blur-md border border-gray-800 p-4 rounded-xl text-center min-w-[100px]">
                        <div class="text-2xl font-bold text-white">{{ Auth::user()->tasks()->where('is_completed', false)->count() }}</div>
                        <div class="text-[10px] uppercase tracking-widest text-gray-500 font-mono">Pending</div>
                    </div>
                    <div class="bg-gray-900/50 backdrop-blur-md border border-gray-800 p-4 rounded-xl text-center min-w-[100px]">
                        <div class="text-2xl font-bold text-emerald-400">{{ Auth::user()->tasks()->where('is_completed', true)->count() }}</div>
                        <div class="text-[10px] uppercase tracking-widest text-gray-500 font-mono">Done</div>
                    </div>
                </div>
            </div>

            <!-- SEARCH BAR -->
            <div class="mb-10 bg-gray-900/40 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 shadow-2xl" x-show="$store.navbar.searchOpen" x-transition>
                <input type="text" x-model="$store.navbar.searchQuery" placeholder="Search tasks..." class="w-full bg-black/50 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
            </div>

            <div class="bg-gray-900/40 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800" x-show="commandCenterVisible && !$store.navbar.focusMode" x-transition>
                <div class="p-8">
                    
                    <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 relative group">
                        @csrf
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Initialize new protocol..." 
                            class="w-full bg-black/50 border border-gray-700 text-white rounded-xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-600"
                            autocomplete="off"
                        >
                    </form>

                    <div class="space-y-3">
                        @foreach (Auth::user()->tasks as $task)
                            <div class="group flex items-center justify-between p-4 bg-gray-800/30 hover:bg-gray-800/60 border border-gray-700/50 hover:border-indigo-500/30 rounded-xl transition-all duration-200" x-show="!$store.navbar.searchQuery || '{{ strtolower($task->title) }}'.includes($store.navbar.searchQuery.toLowerCase())">
                                
                                <div class="flex items-center gap-4 flex-1">
                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="is_completed_toggle" value="1">
                                        <input type="hidden" name="is_completed" value="{{ $task->is_completed ? 0 : 1 }}">
                                        <button type="submit" class="relative flex items-center justify-center w-6 h-6 rounded-md border-2 {{ $task->is_completed ? 'bg-emerald-500 border-emerald-500' : 'border-gray-600 hover:border-indigo-400' }} transition-colors">
                                            @if($task->is_completed)
                                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            @endif
                                        </button>
                                    </form>

                                    <div class="flex flex-col">
                                        @if($task->is_completed)
                                            <span class="text-gray-500 line-through font-medium cursor-default">
                                                {{ $task->title }}
                                            </span>
                                        @else
                                            <a href="{{ route('tasks.show', $task) }}" class="text-gray-200 hover:text-indigo-400 font-medium transition-all cursor-pointer">
                                                {{ $task->title }}
                                            </a>
                                            <span class="text-[10px] text-gray-600 font-mono uppercase tracking-tighter">Goal: {{ $task->time_goal ?? 25 }} MIN</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    {{-- START TIMER BUTTON --}}
                                    @if(!$task->is_completed)
                                        <a href="{{ route('tasks.focus', $task) }}" class="flex items-center gap-2 bg-indigo-500/10 hover:bg-indigo-500 text-indigo-400 hover:text-white px-3 py-1.5 rounded-lg border border-indigo-500/20 transition-all text-xs font-mono" title="Start Session">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" /></svg>
                                            INITIATE
                                        </a>
                                    @endif

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-600 hover:text-red-400 transition-colors p-2" title="Delete Protocol">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        @if(Auth::user()->tasks->isEmpty())
                            <div class="text-center py-10">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-800/50 mb-3 text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </div>
                                <p class="text-gray-500 font-mono text-sm">No active protocols.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- FOCUS MODE VIEW -->
            <div x-show="$store.navbar.focusMode" x-transition class="min-h-[80vh] flex flex-col">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">Focus Mode</h2>
                    <p class="text-gray-400">Your active tasks. Stay focused.</p>
                </div>

                <div class="space-y-4 flex-1">
                    @foreach (Auth::user()->tasks->where('is_completed', false) as $task)
                        <div class="group flex items-center justify-between p-6 bg-gray-800/50 hover:bg-gray-800/80 border border-gray-700/50 hover:border-indigo-500/50 rounded-xl transition-all duration-200">
                            
                            <div class="flex items-center gap-4 flex-1">
                                <form method="POST" action="{{ route('tasks.update', $task) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_completed_toggle" value="1">
                                    <input type="hidden" name="is_completed" value="1">
                                    <button type="submit" class="relative flex items-center justify-center w-6 h-6 rounded-md border-2 border-gray-600 hover:border-indigo-400 transition-colors">
                                    </button>
                                </form>

                                <div class="flex flex-col flex-1">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-lg text-gray-200 hover:text-indigo-400 font-medium transition-all cursor-pointer">
                                        {{ $task->title }}
                                    </a>
                                    <span class="text-sm text-gray-600 font-mono">Goal: {{ $task->time_goal ?? 25 }} MIN</span>
                                </div>
                            </div>

                            <a href="{{ route('tasks.focus', $task) }}" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                START FOCUS
                            </a>
                        </div>
                    @endforeach

                    @if(Auth::user()->tasks->where('is_completed', false)->isEmpty())
                        <div class="text-center py-16">
                            <p class="text-gray-500 text-lg">All tasks completed! 🎉</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>