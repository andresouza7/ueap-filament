{{-- EVENTOS --}}
<section class="py-16 bg-gray-50 border-y border-gray-200">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-ueap-primary">Agenda & Eventos</h2>
                <p class="text-slate-500 text-sm mt-1">Fique por dentro do que acontece na UEAP.</p>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'event']) }}" class="text-sm font-bold text-ueap-primary hover:text-ueap-primary-hover flex items-center gap-2">
                Ver Agenda Completa <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($events as $event)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-6 hover:shadow-md transition-shadow group">
                    {{-- Date Box --}}
                    <div class="flex flex-col items-center justify-center bg-ueap-primary/5 rounded-lg w-20 h-20 shrink-0 text-center border border-ueap-primary/10">
                        <span class="text-xl font-bold text-ueap-primary block leading-none">{{ $event->created_at->format('d') }}</span>
                        <span class="text-xs font-bold text-ueap-primary/70 uppercase tracking-wide mt-1">{{ $event->created_at->format('M') }}</span>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight group-hover:text-ueap-primary transition-colors">
                            <a href="{{ route('site.post.show', $event->slug) }}">
                                {{ $event->title }}
                            </a>
                        </h3>
                        <p class="text-slate-500 text-sm line-clamp-2 mb-3">
                            {{ $event->resume }}
                        </p>
                        <div class="flex items-center gap-4 text-xs font-medium text-slate-400">
                            @if($event->local)
                                <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> {{ $event->local }}</span>
                            @endif
                            <span class="flex items-center gap-1"><i class="fa-regular fa-clock"></i> {{ $event->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
