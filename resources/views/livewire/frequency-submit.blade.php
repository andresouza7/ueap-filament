<div class="grid gap-4">

    <!-- Grid real -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">

        <!-- Formulário (col-span-1) -->
        <div>
            <form wire:submit.prevent="submit">
                {{ $this->form }}
            </form>
        </div>

        <!-- Tabela (col-span-2) -->
        <div class="col-span-2">
            {{ $this->table }}
        </div>

    </div>

    <!-- Último bloco embaixo -->
    <div>
        @php
            $drive = new \App\Services\GoogleDriveService();
            $ponto = new \App\Services\FolhaPontoService($drive);
            $pendencias = $ponto->getPendingSheets(auth()->user());
        @endphp

        <h4>Pontos Pendentes</h4>
        @foreach ($pendencias as $item)
            <span>{{ $item }}</span>
        @endforeach
    </div>

</div>
