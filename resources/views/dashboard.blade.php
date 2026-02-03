<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-black text-white">
    <div class="min-h-screen bg-black">
        <header class="border-b border-gray-800 bg-black">
            <div class="max-w-3xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Chronos</h1>
                        <p class="text-sm text-gray-500 mt-1">Focus on what matters</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-white transition">Log Out</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="max-w-3xl mx-auto px-6 py-8">
            
            <div class="mb-8">
                <form action="{{ route('tasks.store') }}" method="POST" class="relative">
                    @csrf
                    <input 
                        type="text" 
                        name="title"
                        placeholder="Add a new task..." 
                        class="w-full bg-gray-900 border border-gray-800 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-gray-700 focus:bg-gray-850 transition-colors"
                        required
                    >
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </form>
            </div>

            <div class="space-y-1">
                @foreach ($tasks as $task)
                <div class="group flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-900 transition-colors border border-transparent hover:border-gray-800">
                    
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="toggle_completion" value="1">
                        <button type="submit" class="flex-shrink-0 w-6 h-6 rounded-full border-2 transition-colors flex items-center justify-center 
                            {{ $task->is_completed ? 'border-gray-600 bg-gray-800' : 'border-gray-700 hover:border-gray-600' }}">
                            
                            @if($task->is_completed)
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            @else
                                <svg class="w-4 h-4 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            @endif
                        </button>
                    </form>

                    <a href="{{ route('tasks.show', $task) }}" class="flex-1 font-500 {{ $task->is_completed ? 'text-gray-500 line-through' : 'text-white' }}">
                        {{ $task->title }}
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex-shrink-0 p-1.5 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-gray-800 rounded-lg">
                            <svg class="w-5 h-5 text-gray-500 hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            @if($tasks->isEmpty())
            <div class="mt-12 text-center text-gray-600 text-sm">
                <p>No tasks yet. Add one above.</p>
            </div>
            @endif
        </main>
    </div>
</body>
</html>