<div>
    <form wire:submit.prevent="saveSignature">
        {{ $this->form }}
        <br>

    </form>

    <p class="text-sm font-medium">Minha assinatura:</p>
    @if(auth()->user()->signature_url)
        <img src="{{ auth()->user()->signature_url }}" alt="assinatura" width="350px" height="auto">
    @else
        <p>Assinatura não cadastrada</p>
    @endif
</div>
