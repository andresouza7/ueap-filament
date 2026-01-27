@props([
    'categories' => [],
])

<section class="w-full" aria-labelledby="sidebar-categories-title">
    {{-- HEADER --}}
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h3 id="sidebar-categories-title"
            class="text-2xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase pl-4 border-l-4 border-ueap-green">
            Assuntos
        </h3>
    </div>

    {{-- Tags --}}
    <div class="flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <a href="{{ route('site.post.list', ['category' => $category->slug]) }}"
                class="p-2 bg-slate-50 border border-slate-200 text-ueap-blue-dark text-[10px] font-bold uppercase tracking-widest hover:bg-ueap-blue-dark hover:text-white transition-all rounded-none">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</section>
