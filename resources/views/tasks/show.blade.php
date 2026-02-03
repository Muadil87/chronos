<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronos - Mission Briefing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        
        /* Smooth fade for the selection ring */
        .ring-transition { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-black text-white selection:bg-indigo-500/30">
    <div class="min-h-screen bg-black">
        
        <header class="border-b border-gray-900 bg-black/50 backdrop-blur-md sticky top-0 z-10">
            <div class="max-w-3xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-white transition-colors group">
                    <svg class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <span class="text-xs font-mono text-gray-700 uppercase tracking-widest">Mission Control</span>
            </div>
        </header>

        <main class="max-w-3xl mx-auto px-6 py-12">
            
            <div class="mb-12">
                <h1 class="text-4xl font-bold tracking-tight mb-4 text-white">{{ $task->title }}</h1>
                <p class="text-gray-400 text-lg leading-relaxed">{{ $task->description }}</p>
            </div>

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 mb-8">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-gray-400 text-xs font-semibold uppercase tracking-widest">Session Structure</h3>
                        <span class="text-xs font-mono text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-2 py-1 rounded">
                            20m Focus • 5m Rest
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <button type="button" onclick="setCycles(1)" id="btn-1h" class="relative group p-4 rounded-xl border border-gray-800 bg-black hover:border-indigo-500/50 hover:bg-gray-800 transition-all text-left ring-transition">
                            <div class="text-2xl font-bold text-white mb-1">1 hr</div>
                            <div class="text-xs text-gray-500 group-hover:text-gray-400">3 Cycles</div>
                            <div class="absolute inset-0 border-2 border-indigo-500 rounded-xl opacity-0 scale-95 ring-transition pointer-events-none" id="ring-1h"></div>
                        </button>

                        <button type="button" onclick="setCycles(2)" id="btn-2h" class="relative group p-4 rounded-xl border border-gray-800 bg-black hover:border-indigo-500/50 hover:bg-gray-800 transition-all text-left ring-transition">
                            <div class="text-2xl font-bold text-white mb-1">2 hrs</div>
                            <div class="text-xs text-gray-500 group-hover:text-gray-400">6 Cycles</div>
                            <div class="absolute inset-0 border-2 border-indigo-500 rounded-xl opacity-0 scale-95 ring-transition pointer-events-none" id="ring-2h"></div>
                        </button>

                        <button type="button" onclick="setCycles(3)" id="btn-3h" class="relative group p-4 rounded-xl border border-gray-800 bg-black hover:border-indigo-500/50 hover:bg-gray-800 transition-all text-left ring-transition">
                            <div class="text-2xl font-bold text-white mb-1">3 hrs</div>
                            <div class="text-xs text-gray-500 group-hover:text-gray-400">9 Cycles</div>
                            <div class="absolute inset-0 border-2 border-indigo-500 rounded-xl opacity-0 scale-95 ring-transition pointer-events-none" id="ring-3h"></div>
                        </button>
                    </div>

                    <div class="mb-2 flex justify-between text-[10px] text-gray-500 font-mono tracking-wider">
                        <span>START</span>
                        <span id="total-time-display">75 MIN TOTAL</span>
                    </div>
                    
                    <div class="flex h-2 w-full rounded-full overflow-hidden bg-gray-800/50 mb-4" id="timeline-bar">
                        </div>
                    
                    <div class="flex gap-6 mt-4 text-xs text-gray-500 border-t border-gray-800 pt-4">
                        <div class="flex items-center"><div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></div> Focus (20m)</div>
                        <div class="flex items-center"><div class="w-1.5 h-1.5 rounded-full bg-gray-600 mr-2"></div> Rest (5m)</div>
                    </div>

                    <input type="hidden" name="time_goal" id="real-time-input" value="75"> 
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-1 mb-8">
                    <textarea name="description" rows="4" placeholder="What’s on your mind? Let’s get it done."
                        class="w-full bg-transparent border-0 rounded-lg px-4 py-3 text-gray-300 placeholder-gray-600 focus:ring-0 focus:outline-none resize-none leading-relaxed">{{ $task->description }}</textarea>
                </div>

                <div class="flex gap-4 items-center">
                    <a href="{{ route('tasks.focus', $task) }}" class="flex-1 bg-white text-black font-semibold py-4 px-6 rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center gap-2 group shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_25px_rgba(255,255,255,0.2)]">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path></svg>
                        Start Focus Session
                    </a>

                    <button type="submit" class="px-6 py-4 rounded-xl border border-gray-800 text-gray-400 hover:text-white hover:bg-gray-800 hover:border-gray-700 transition-all font-medium">
                        Save Notes
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        function setCycles(hours) {
            // Logic: 1 hour = 3 cycles (20m work + 5m break = 25m block)
            const cyclesPerHour = 3;
            const totalCycles = hours * cyclesPerHour;
            const totalMinutes = totalCycles * 25;

            // Update Hidden Input for Laravel
            document.getElementById('real-time-input').value = totalMinutes;
            document.getElementById('total-time-display').innerText = totalMinutes + " MIN TOTAL";

            // Update Visual Selection State
            // 1. Reset all buttons
            document.querySelectorAll('[id^="btn-"]').forEach(btn => {
                btn.classList.remove('bg-gray-800', 'border-gray-600');
                btn.classList.add('bg-black', 'border-gray-800');
            });
            document.querySelectorAll('[id^="ring-"]').forEach(ring => {
                ring.classList.add('opacity-0', 'scale-95');
                ring.classList.remove('opacity-100', 'scale-100');
            });

            // 2. Activate clicked button
            const activeBtn = document.getElementById(`btn-${hours}h`);
            const activeRing = document.getElementById(`ring-${hours}h`);
            
            if(activeBtn) {
                activeBtn.classList.remove('bg-black', 'border-gray-800');
                activeBtn.classList.add('bg-gray-800', 'border-gray-600');
            }
            if(activeRing) {
                activeRing.classList.remove('opacity-0', 'scale-95');
                activeRing.classList.add('opacity-100', 'scale-100');
            }

            // 3. Draw the Timeline
            drawTimeline(totalCycles);
        }

        function drawTimeline(cycles) {
            const container = document.getElementById('timeline-bar');
            container.innerHTML = ''; // Clear

            for (let i = 0; i < cycles; i++) {
                // Focus Segment (Indigo)
                const focusSeg = document.createElement('div');
                focusSeg.className = 'bg-indigo-500 h-full border-r border-black/50 last:border-0';
                focusSeg.style.width = '80%'; // Visual approximation of 20m vs 5m
                
                // Break Segment (Gray)
                const breakSeg = document.createElement('div');
                breakSeg.className = 'bg-gray-700 h-full border-r border-black/50 last:border-0';
                breakSeg.style.width = '20%';

                container.appendChild(focusSeg);
                
                // Add break segment unless it's the very last cycle (optional preference, 
                // but usually you want a break at the end of a cycle)
                container.appendChild(breakSeg);
            }
        }

        // Initialize Default (1 Hour)
        setCycles(1);
    </script>
</body>
</html>