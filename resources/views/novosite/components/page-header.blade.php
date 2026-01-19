@props([
    'title',
    'subtitle' => null,
    'breadcrumb' => [], // Array of ['label' => '...', 'url' => '...']
    'bgImage' => null
])

<header class="relative bg-ueap-primary py-12 lg:py-16 overflow-hidden border-b-8 border-ueap-secondary">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 pointer-events-none z-0 opacity-10">
        <div class="absolute inset-0"
             style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
    </div>

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white">

        {{-- Breadcrumb --}}
        @if(count($breadcrumb) > 0)
            <nav class="flex items-center gap-2 text-xs md:text-sm font-medium mb-6 opacity-80" aria-label="Breadcrumb">
                <a href="/" class="hover:text-ueap-secondary transition-colors">Início</a>
                @foreach($breadcrumb as $item)
                    <span class="text-ueap-secondary/50">/</span>
                    @if(isset($item['url']) && $item['url'])
                        <a href="{{ $item['url'] }}" class="hover:text-ueap-secondary transition-colors">{{ $item['label'] }}</a>
                    @else
                        <span class="text-white">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        {{-- Titles --}}
        <div class="max-w-4xl">
            @if($subtitle)
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-ueap-secondary text-ueap-primary text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm">
                        {{ $subtitle }}
                    </span>
                </div>
            @endif

            <h1 class="text-3xl md:text-5xl font-bold tracking-tight leading-tight">
                {{ $title }}<span class="text-ueap-secondary">.</span>
            </h1>

            @if(isset($slot) && $slot->isNotEmpty())
                <div class="mt-8 pt-8 border-t border-white/10">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</header>
