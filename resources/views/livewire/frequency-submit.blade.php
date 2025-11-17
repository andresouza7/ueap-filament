<div class="flex flex-col gap-4">
    <form wire:submit.prevent="submit">
        {{ $this->form }}
    </form>

    <div>
        {{ $this->table }}
    </div>

    <div>
        @php
            $drive = new \App\Services\GoogleDriveService();
            $ponto = new \App\Services\FolhaPontoService($drive);

            $pendencias = $ponto->getPendingSheets(auth()->user());
        @endphp

        <h4>minhas pendências</h4>
        @foreach ($pendencias as $item)
            <span>{{ $item }}</span>
        @endforeach
    </div>
</div>