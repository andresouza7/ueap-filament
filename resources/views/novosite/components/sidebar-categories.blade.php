@props([
    'categories' => [],
])

<section>
    <div class="flex items-center gap-3 mb-5">
        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-gray-500 whitespace-nowrap">
            Assuntos
        </h3>
        <div class="h-px flex-1 bg-gradient-to-r from-gray-100 to-transparent"></div>
    </div>

    <div class="flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <a href="{{ route('site.post.list', ['category' => $category->slug]) }}"
                class="px-3.5 py-2 bg-white border border-gray-200 rounded-full text-[11px] font-bold text-gray-500 hover:bg-[#017D49] hover:text-white hover:border-[#017D49] hover:shadow-md transition-all duration-300 uppercase tracking-tighter">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</section>
