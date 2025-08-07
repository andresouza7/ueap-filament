@extends('transparency.template.master')

@section('title')
    {{ type(request('slug')) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <div class="d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ $category->name }}</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <a class="btn btn-sm btn-dark" href="{{ route('transparency.home') }}"><i
                                            class="fa fa-mail-reply-all"></i> Voltar</a>
                                </div>
                            </div>
                        </div>

                        {{-- <form autocomplete="off" action="" class="mt-3">
                            <div>
                                <label>Ano: </label>
                                <div class="btn-group" role="group">
                                    <select class="form-control" id="text" type="text" name="year">
                                        @php
                                            $atualYear = date('Y');
                                        @endphp
                                        @for ($y = $atualYear; $y >= 2010; $y--)
                                            <option @if ($y == $year) selected @endif
                                                value={{ $y }}> {{ $y }}</option>
                                        @endfor

                                    </select>

                                    <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-primary">
                                            Filtrar
                                        </button>

                                        <a href="{{ route('transparency.document.list', ['slug' => $type]) }}" class="btn btn-danger" title="Limpar filtro">
                                            <i class="fa fa-times"></i> 
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </form> --}}
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table {!! class_table() !!}>
                                <thead>
                                    <tr role="row">
                                        <th>De</th>
                                        <th>Até</th>
                                        <th>Descrição</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($documents as $document)
                                        <tr role="row" class="odd">
                                            <td>{{ $document->year }}</td>
                                            <td>{{ $document->year_end }}</td>
                                            <td>{{ $document->description }}</td>
                                            <td>
                                                @if (file_exists(public_path('storage/documents/general/' . $document->id . '.pdf')))
                                                    <a class='btn btn-sm btn-success white' target='blank'
                                                        href='{{ asset('storage/documents/general/' . $document->id . '.pdf') }}'>
                                                        <i class='fa fa-search'></i>
                                                    </a>
                                                @else
                                                    <span> - </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr role="row" class="odd">
                                            <td colspan="7">Nenhum Registro Encontrado</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>

                            <ul class="m-3 pagination pagination-circle">
                                {!! $documents->links() !!}
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
