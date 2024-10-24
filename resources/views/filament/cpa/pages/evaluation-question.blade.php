<x-filament-panels::page>
    <div>
        <pre>Ava ID: {{ $evaluation->id }}</pre>
        <pre>Pessoa: {{ $evaluation->respondent->name }}</pre>
        <pre>Categoria: {{ $evaluation->category->name }}</pre>
    </div>




    <x-filament::section>
        <x-slot name="heading">
            Questionário de Avaliação CPA
        </x-slot>

        <x-slot name="description">
            Suas respostas serão salvas automaticamente,
            permitindo que você retorne e termine posteriormente.
        </x-slot>

        {{-- Content --}}
        <div class="flex flex-col gap-6">
            <div class="flex flex-col items-center">
                <label for="progress" class="text-sm font-semibold">Avaliação {{ $evaluation->progress }}%
                    concluída</label>
                <progress id="progress" value="{{ $evaluation->progress }}" max="100" class="w-full">
                    {{ $evaluation->progress }}
                </progress>
            </div>

            @if ($answer)
                <div>
                    <label for="" class="text-sm font-base">Escopo</label>
                    <h1 class="font-semibold">{{ $answer->question->dimension->name }}</h1>
                </div>
                <div>
                    <label for="" class="text-sm font-base">Pergunta</label>
                    <h1 class="font-semibold">{{ $answer->question->title }}</h1>
                </div>

                <form wire:submit="onAnswerQuestion">
                    {{ $this->form }}

                    <x-filament::button type="submit" tag="button" class="mt-3">
                        Responder
                    </x-filament::button>
                </form>
            @else
                <h1 class="font-semibold">Suas respostas foram registradas!</h1>
                <div>Obrigado por participar.</div>

                <x-filament::button wire:click="onClearAnswers" tag="button">
                    Recomeçar
                </x-filament::button>
            @endif
        </div>
    </x-filament::section>

    {{-- {{ $this->form }}

    <div class="flex gap-4">
        <x-filament::button wire:click="onGoBack" tag="button">
            Anterior
        </x-filament::button>
        <x-filament::button wire:click="onAnswerQuestion" tag="button">
            Próxima
        </x-filament::button>
    </div> --}}
</x-filament-panels::page>
