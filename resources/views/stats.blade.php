<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Pilot Stats</title>
    <link rel="icon" href="/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-black text-white min-h-screen p-8">

    <header class="max-w-3xl mx-auto flex justify-between items-center mb-16">
        <div class="flex items-center gap-4">
            <img src="/logo.png" alt="Chronos Logo" class="h-20 w-auto object-contain">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-white transition-colors group">
                <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="text-base font-mono uppercase tracking-widest">Back to Mission Control</span>
            </a>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-900 hover:text-red-500 text-sm font-mono uppercase tracking-widest transition-colors">
                Log Out
            </button>
        </form>
    </header>

    <main class="max-w-3xl mx-auto">
        
        <div class="flex items-end justify-between border-b border-gray-900 pb-6 mb-10">
            <div>
                <h2 class="text-gray-500 text-sm font-mono uppercase tracking-widest mb-2">Pilot Profile</h2>
                <h1 class="text-5xl font-bold text-white">{{ auth()->user()->name }}</h1>
                <p class="text-gray-600 text-base mt-1">{{ auth()->user()->email }}</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500 font-mono uppercase tracking-widest mb-1">Total Focus Time</div>
                <div class="text-5xl font-mono text-indigo-500 font-bold">
                    {{ $hours }}<span class="text-2xl text-gray-600">h</span> 
                    {{ $minutes }}<span class="text-2xl text-gray-600">m</span>
                </div>
            </div>
        </div>

        <div class="grid gap-6">
            <h3 class="text-gray-500 text-sm font-mono uppercase tracking-widest mb-2">Mission Log (By Duration)</h3>
            
            @foreach($tasks as $task)
            <div class="group bg-gray-900/30 border border-gray-800 hover:border-indigo-500/50 rounded-xl p-5 transition-all">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-semibold text-xl text-gray-200 group-hover:text-white">{{ $task->title }}</h4>
                    <span class="font-mono text-indigo-400 bg-indigo-500/10 px-3 py-1 rounded text-base">
                        {{ $task->time_spent }} / {{ $task->time_goal ?? 25 }} min
                    </span>
                </div>
                
                @php
                    $goalMinutes = $task->time_goal ?? 25;
                    $percentage = $goalMinutes > 0 ? min(($task->time_spent / $goalMinutes) * 100, 100) : 0;
                @endphp
                <div class="w-full bg-gray-800 rounded-full h-2 overflow-hidden">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all" style="width: <?php echo $percentage; ?>%;"></div>
                </div>
                <div class="text-xs text-gray-500 mt-2">{{ round($percentage, 1) }}% complete</div>
            </div>
            @endforeach
            
            @if($tasks->isEmpty())
                <div class="text-center py-12 border border-dashed border-gray-800 rounded-xl">
                    <p class="text-gray-600">No missions recorded yet.</p>
                </div>
            @endif

        </div>
    </main>
</body>
</html>