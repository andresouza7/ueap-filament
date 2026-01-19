@props([
    'title',
    'subtitle' => null,
    'breadcrumb' => [],
    'bgImage' => null
])

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-ueap mx-auto px-4 lg:px-8 py-10 lg:py-12">

        {{-- Breadcrumb --}}
        @if(count($breadcrumb) > 0)
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-4" aria-label="Breadcrumb">
                <a href="/" class="hover:text-ueap-primary transition-colors">Início</a>
                @foreach($breadcrumb as $item)
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                    @if(isset($item['url']) && $item['url'])
                        <a href="{{ $item['url'] }}" class="hover:text-ueap-primary transition-colors">{{ $item['label'] }}</a>
                    @else
                        <span class="text-slate-800 font-semibold">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                @if($subtitle)
                    <span class="text-ueap-primary font-bold text-xs uppercase tracking-wider mb-2 block">
                        {{ $subtitle }}
                    </span>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                    {{ $title }}
                </h1>
            </div>

            @if(isset($slot) && $slot->isNotEmpty())
                <div class="md:text-right">
                    {{ $slot }}
                </div>
            @endif
        </div>

    </div>
</div>
