@props([
    'title',
    'subtitle' => null,
    'breadcrumb' => [],
    'bgImage' => null
])

<header class="relative bg-ueap-primary py-16 lg:py-24 overflow-hidden border-b-8 border-ueap-secondary">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 pointer-events-none z-0 opacity-10">
        <div class="absolute inset-0"
             style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>

    {{-- Decorative Circle --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full border border-white/10 opacity-50"></div>
    <div class="absolute top-1/2 -left-24 w-64 h-64 rounded-full bg-white/5 blur-3xl"></div>

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white">

        {{-- Breadcrumb --}}
        @if(count($breadcrumb) > 0)
            <nav class="flex items-center gap-3 text-xs md:text-sm font-medium mb-8 opacity-70 font-sans tracking-wide" aria-label="Breadcrumb">
                <a href="/" class="hover:text-ueap-secondary transition-colors uppercase">Início</a>
                @foreach($breadcrumb as $item)
                    <span class="text-ueap-secondary/50">/</span>
                    @if(isset($item['url']) && $item['url'])
                        <a href="{{ $item['url'] }}" class="hover:text-ueap-secondary transition-colors uppercase">{{ $item['label'] }}</a>
                    @else
                        <span class="text-white uppercase font-bold">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        {{-- Titles --}}
        <div class="max-w-4xl">
            @if($subtitle)
                <div class="flex items-center gap-3 mb-6">
                    <span class="h-px w-8 bg-ueap-secondary"></span>
                    <span class="text-ueap-secondary text-sm font-bold uppercase tracking-[0.2em] font-sans">
                        {{ $subtitle }}
                    </span>
                </div>
            @endif

            <h1 class="text-4xl md:text-6xl font-serif font-bold tracking-tight leading-[1.1] mb-2">
                {{ $title }}
            </h1>

            <div class="h-1.5 w-24 bg-ueap-secondary mt-8 rounded-full"></div>

            @if(isset($slot) && $slot->isNotEmpty())
                <div class="mt-10 pt-8 border-t border-white/10 font-sans">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</header>
