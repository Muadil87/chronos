<x-app-layout>
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-900/10 rounded-full blur-[100px] opacity-40"></div>
    </div>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-white flex items-center gap-2 transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Command Center
                </a>
                
                @if (session('status'))
                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-emerald-400 text-xs font-mono bg-emerald-900/20 px-3 py-1 rounded-full border border-emerald-900/50">
                        {{ session('status') }}
                    </span>
                @endif
            </div>

            <div class="bg-gray-900/40 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 shadow-2xl relative overflow-hidden">
                
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-50"></div>

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-white tracking-tight">Mission Briefing</h1>
                    <p class="text-gray-500 text-sm mt-1">Define parameters and objectives for this protocol.</p>
                </div>

                <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Protocol Name</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" 
                            class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700 font-medium">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">
                                Time Allocation (Minutes)
                            </label>
                            <div class="relative">
                                <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $task->duration_minutes) }}" 
                                    class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700 font-mono"
                                    placeholder="60">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs pointer-events-none">MIN</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Current Status</label>
                            <div class="flex items-center justify-between bg-black/30 border border-gray-800 rounded-xl px-4 py-3">
                                <span class="text-sm {{ $task->is_completed ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $task->is_completed ? 'COMPLETED' : 'PENDING' }}
                                </span>
                                <div class="w-2 h-2 rounded-full {{ $task->is_completed ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : 'bg-amber-500 shadow-[0_0_10px_rgba(245,158,11,0.5)]' }}"></div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Mission Intelligence / Notes</label>
                        <textarea name="notes" rows="6" 
                            class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-gray-700 leading-relaxed resize-none"
                            placeholder="Enter detailed objectives, resources, or sub-tasks here...">{{ old('notes', $task->notes) }}</textarea>
                    </div>

                    <div class="pt-4 flex items-center justify-between border-t border-gray-800 mt-6">
                        
                        <button type="button" onclick="document.getElementById('delete-form').submit()" class="text-xs text-red-500 hover:text-red-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Terminate Protocol
                        </button>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Save Updates
                        </button>
                    </div>
                </form>

                <form id="delete-form" action="{{ route('tasks.destroy', $task) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>
</x-app-layout>