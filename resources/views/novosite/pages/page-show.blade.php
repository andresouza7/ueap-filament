@extends('novosite.template.master')

@section('title', isset($page->title) ? $page->title : (isset($page->slug) ? str_replace('-', ' ', ucfirst($page->slug))
    : 'Página'))

@section('content')
    <div class="flex flex-col">
        {{-- Recomendo mover estas tags para <head> do master para evitar repetição --}}
        <link
            href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;700;1,400&family=Inter:400,600,700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">

        <section class="w-full py-8 border-b border-gray-200">
            <div class="max-w-[1290px] mx-auto space-y-12">
                @php
                    use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
                    use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\StaffBlock;
                    use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\CurriculumBlock;
                    use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\CourseCoordinator;
                    use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\SimpleTextSection;

                @endphp
                {{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($page->content)->customBlocks([
                    HeroBlock::class,
                    StaffBlock::class,
                    CurriculumBlock::class,
                    CourseCoordinator::class,
                    SimpleTextSection::class,
                ]) }}
            </div>
        </section>
    </div>
@endsection
