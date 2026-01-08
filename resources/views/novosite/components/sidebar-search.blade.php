@props([
    'value' => '',
    'name' => 'search',
    'placeholder' => 'O que você procura?',
])

<section {{ $attributes->merge(['class' => 'w-full']) }}>
    <form class="relative group" action="{{ route('site.post.list') }}" method="GET">
        {{-- Mantém o tipo e a categoria ativos durante a busca --}}
        @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
            class="w-full bg-gray-50/50 border-b border-gray-200 py-3 px-2 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:border-[#017D49] transition-all duration-500 text-sm italic">
        <button
            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#017D49] transition-colors">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
        </button>
    </form>
</section>
