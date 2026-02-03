<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chronos - Active Session</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.1); border-color: rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 60px rgba(99, 102, 241, 0.25); border-color: rgba(99, 102, 241, 0.6); }
        }
        @keyframes pulse-green {
            0%, 100% { box-shadow: 0 0 30px rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.3); }
            50% { box-shadow: 0 0 60px rgba(34, 197, 94, 0.25); border-color: rgba(34, 197, 94, 0.6); }
        }
        
        .mode-focus { animation: pulse-glow 4s infinite; }
        .mode-rest { animation: pulse-green 4s infinite; }
    </style>
</head>
<body class="bg-black text-white h-screen flex flex-col overflow-y-auto">

    <header class="flex justify-between items-center px-8 py-6 border-b border-gray-900 bg-black/50 backdrop-blur z-20 shrink-0">
        <a href="{{ route('dashboard') }}" onclick="return confirm('Discard progress and go back?')" class="group flex items-center gap-2 text-gray-400 hover:text-red-400 transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span>CANCEL</span>
        </a>
        
        <div class="flex items-center gap-3">
            <span class="relative flex h-3 w-3">
              <span id="status-dot-ping" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
              <span id="status-dot" class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
            </span>
            <span id="system-status" class="text-xs font-mono text-gray-500 uppercase tracking-widest">System Active</span>
        </div>
        
        <button onclick="finishSession()" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
            <span>FINISH & SAVE</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </button>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center relative z-10 py-4 min-h-[600px]">
        
        <div class="text-center w-full px-4 mb-6">
            <h2 class="text-gray-500 text-xs font-mono uppercase tracking-[0.2em] mb-2">Current Objective</h2>
            <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">{{ $task->title }}</h1>
        </div>

        <div id="timer-container" class="mode-focus relative w-72 h-72 md:w-96 md:h-96 lg:w-[500px] lg:h-[500px] rounded-full border border-gray-800 bg-gray-900/20 backdrop-blur-sm flex flex-col items-center justify-center transition-all duration-1000">
            
            <div id="phase-badge" class="mb-4 md:mb-6 px-4 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-400 text-xs font-mono uppercase tracking-widest">
                Focus Cycle
            </div>

            <div id="timer-display" class="text-6xl md:text-8xl lg:text-9xl font-mono font-bold text-white tracking-tighter mb-4 tabular-nums">
            </div>

            <div class="flex items-center gap-4 text-sm font-medium text-gray-500">
                <span>CYCLE</span>
                <span class="text-white px-3 py-1 bg-gray-800 rounded text-xs font-mono">
                    <span id="current-cycle">1</span> / <span id="total-cycles">{{ ceil(($task->time_goal ?? 25) / 25) }}</span>
                </span>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-8">
            
            <button onclick="resetTimer()" class="group flex flex-col items-center gap-2 text-gray-500 hover:text-white transition-colors">
                <div class="w-12 h-12 rounded-full border border-gray-800 bg-gray-900/50 flex items-center justify-center group-hover:border-gray-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <span class="text-[10px] uppercase tracking-widest font-mono opacity-0 group-hover:opacity-100 transition-opacity">Reset</span>
            </button>

            <button onclick="toggleTimer()" id="play-btn" class="w-20 h-20 rounded-full bg-white text-black flex items-center justify-center hover:scale-105 hover:shadow-[0_0_30px_rgba(255,255,255,0.2)] transition-all">
                <svg id="icon-pause" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/></svg>
                <svg id="icon-play" class="w-8 h-8 hidden pl-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </button>
            
            <button onclick="skipPhase()" class="group flex flex-col items-center gap-2 text-gray-500 hover:text-white transition-colors">
                <div class="w-12 h-12 rounded-full border border-gray-800 bg-gray-900/50 flex items-center justify-center group-hover:border-gray-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </div>
                <span class="text-[10px] uppercase tracking-widest font-mono opacity-0 group-hover:opacity-100 transition-opacity">Skip</span>
            </button>
        </div>

    </main>

    <script>
        // Settings: standard cycle lengths
        const STANDARD_FOCUS_MINUTES = 25;
        const STANDARD_REST_MINUTES = 5;
        const TOTAL_FOCUS_MINUTES = <?php echo (int)($task->time_goal ?? 25); ?>;
        const TASK_ID = <?php echo (int)$task->id; ?>;

        const STANDARD_FOCUS_SECONDS = STANDARD_FOCUS_MINUTES * 60;
        const STANDARD_REST_SECONDS = STANDARD_REST_MINUTES * 60;

        // Remaining focus time for this task (seconds)
        let remainingFocusSeconds = TOTAL_FOCUS_MINUTES * 60;
        let TOTAL_CYCLES = Math.ceil(TOTAL_FOCUS_MINUTES / STANDARD_FOCUS_MINUTES);

        // Current phase
        let currentPhaseDuration = Math.min(STANDARD_FOCUS_SECONDS, remainingFocusSeconds);
        let timeLeft = currentPhaseDuration;
        let isRunning = true;
        let mode = 'focus';
        let cycle = 1;
        let timerInterval;
        let totalSecondsFocused = 0;

        // Elements
        const elDisplay = document.getElementById('timer-display');
        const elContainer = document.getElementById('timer-container');
        const elBadge = document.getElementById('phase-badge');
        const elCurrentCycle = document.getElementById('current-cycle');
        const elStatusDot = document.getElementById('status-dot');
        const elStatusPing = document.getElementById('status-dot-ping');

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }

        function updateUI() {
            elDisplay.innerText = formatTime(timeLeft);
            document.title = `${formatTime(timeLeft)} - Chronos`;
        }

        function switchMode() {
            if (mode === 'focus') {
                // Completed a focus phase
                remainingFocusSeconds -= currentPhaseDuration;

                // If we've finished all required focus time, wrap up
                if (remainingFocusSeconds <= 0) {
                    finishSession();
                    return;
                }

                // Enter rest
                mode = 'rest';
                timeLeft = STANDARD_REST_SECONDS;
                elContainer.classList.replace('mode-focus', 'mode-rest');
                elBadge.innerText = "Rest & Recover";
                elBadge.className = "mb-4 md:mb-6 px-4 py-1 rounded-full border border-green-500/30 bg-green-500/10 text-green-400 text-xs font-mono uppercase tracking-widest";
                elStatusDot.classList.replace('bg-indigo-500', 'bg-green-500');
                elStatusPing.classList.replace('bg-indigo-400', 'bg-green-400');
                new Notification("Chronos", { body: "Focus cycle complete. Take a short break." });
            } else {
                // Rest finished -> start next focus phase
                if (remainingFocusSeconds <= 0) {
                    finishSession();
                    return;
                }

                mode = 'focus';
                currentPhaseDuration = Math.min(STANDARD_FOCUS_SECONDS, remainingFocusSeconds);
                timeLeft = currentPhaseDuration;
                cycle++;
                elCurrentCycle.innerText = cycle;
                elContainer.classList.replace('mode-rest', 'mode-focus');
                elBadge.innerText = "Focus Cycle";
                elBadge.className = "mb-4 md:mb-6 px-4 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-400 text-xs font-mono uppercase tracking-widest";
                elStatusDot.classList.replace('bg-green-500', 'bg-indigo-500');
                elStatusPing.classList.replace('bg-green-400', 'bg-indigo-400');
                new Notification("Chronos", { body: "Break over. Start next focus session." });
            }
            updateUI();
        }

        function tick() {
            if (!isRunning) return;

            if (mode === 'focus') {
                totalSecondsFocused++;
            }

            if (timeLeft > 0) {
                timeLeft--;
                updateUI();
            } else {
                switchMode();
            }
        }

        function toggleTimer() {
            isRunning = !isRunning;
            document.getElementById('icon-pause').classList.toggle('hidden');
            document.getElementById('icon-play').classList.toggle('hidden');
            elContainer.style.opacity = isRunning ? "1" : "0.5";
        }

        function skipPhase() {
            timeLeft = 0;
            tick();
        }

        function resetTimer() {
            isRunning = false;
            if (mode === 'focus') {
                timeLeft = currentPhaseDuration;
            } else {
                timeLeft = STANDARD_REST_SECONDS;
            }
            updateUI();
            document.getElementById('icon-pause').classList.add('hidden');
            document.getElementById('icon-play').classList.remove('hidden');
            elContainer.style.opacity = "0.5";
        }

        async function finishSession() {
            // stop the timer
            isRunning = false;
            clearInterval(timerInterval);

            const minutes = Math.ceil(totalSecondsFocused / 60);

            if (minutes > 0) {
                try {
                    const response = await fetch(`/tasks/${TASK_ID}/record`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ minutes: minutes })
                    });

                    if(response.ok) {
                        window.location.href = "{{ route('dashboard') }}";
                    } else {
                        alert('Error saving session.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    window.location.href = "{{ route('dashboard') }}";
                }
            } else {
                window.location.href = "{{ route('dashboard') }}";
            }
        }

        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }

        // Start ticking
        timerInterval = setInterval(tick, 1000);
        updateUI();
    </script>
</body>
</html>