<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 btn-primary-gradient border border-transparent rounded-full font-semibold text-sm uppercase tracking-wide hover:scale-105 active:scale-100 focus:outline-none focus:ring-4 focus:ring-indigo-400 focus:ring-opacity-30 accent-outline transition-transform duration-150']) }}>
    {{ $slot }}
</button>
