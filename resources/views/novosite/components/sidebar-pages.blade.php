@props([
    'pages' => []
])

<section>
    <div class="flex items-center gap-3 mb-4">
        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-gray-500 whitespace-nowrap">
            Páginas Frequentes
        </h3>
        <div class="h-px flex-1 bg-gradient-to-r from-gray-100 to-transparent"></div>
    </div>

    <div class="flex flex-col">
        @foreach ($pages as $page)
            <a href="#" class="group flex items-center gap-3 py-2.5 border-b border-gray-50 last:border-0">
                <span
                    class="w-1.5 h-1.5 rounded-full bg-gray-200 group-hover:bg-[#017D49] group-hover:scale-125 transition-all"></span>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-gray-900 transition-colors flex-1">
                    {{ $page->title }}
                </span>
                <i
                    class="fa-solid fa-arrow-right-long text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#017D49] transition-all"></i>
            </a>
        @endforeach
    </div>
</section>
