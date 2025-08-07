<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function checkType($type)
    {
        $check = DocumentCategory::where('slug', $type)->first();

        if ($check) {
            return true;
        }
        return false;
    }

    public function list($type, Request $request)
    {
        if ($this->checkType($type)) {
            $query = Document::where('type', $type)->orderByDesc('year')->orderBy('title');

            if ($request->filter_title) {
                $query->where('title', 'ilike', "%$request->filter_title%");
            }

            if ($request->filter_description) {
                $query->where('description', 'ilike', "%$request->filter_description%");
            }

            if ($request->filter_year) {
                $query->where('year',  $request->filter_year);
            }

            $documents = $query->paginate(25)->withQueryString();

            return view('manager.modules.document-general.list', compact('type', 'documents'));
        }
        return redirect()->route('manager.home');
    }

    public function show($type, $uuid)
    {
        if ($this->checkType($type)) {
            $document = Document::where('uuid', $uuid)->first();
            return view('manager.modules.document-general.show', compact('type', 'document'));
        }
        return redirect()->route('manager.home');
    }


    public function create($type)
    {
        if ($this->checkType($type)) {
            return view('manager.modules.document-general.create', compact('type'));
        }

        return redirect()->route('manager.home');
    }



    public function store($type, Request $request)
    {

        $rules = [
            'title' => 'required',
            'description' => 'max:255',
            'document' => 'required|mimes:pdf|max:10200',
        ];

        // Check if the authenticated user has the role dinfo
        if (!auth()->user()->hasRole('dinfo')) {
            $rules['document'] .= '|max:51200';
        }

        $request->validate($rules);

        $document = Document::create([
            'uuid' => Str::uuid(),
            'type' => $type,
            'year' => $request->year,
            'year_end' => $request->year_end,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'published',
            'user_created_id' => auth()->user()->id
        ]);


        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $name = $document->id . ".pdf";
            $request->document->storeAs('documents/general', $name);
        }

        return redirect()->route('manager.document.general.list', $type);
    }



    public function update($type, $uuid)
    {
        if ($this->checkType($type)) {
            $document = Document::where('uuid', $uuid)->first();
            return view('manager.modules.document-general.update', compact('type', 'document'));
        }

        return redirect()->route('manager.document.general.list', $type)
            ->with('error', 'Documento Não encontrado');
    }

    public function put($type,  $uuid, Request $request)
    {

        $rules = [
            'title' => 'required',
            'year' => 'required',
            'description' => 'max:255',
            'document' => 'required|mimes:pdf',
            'thumbnail' => 'nullable|file|mimes:jpg',
        ];

        // Check if the authenticated user has the role dinfo
        if (!auth()->user()->hasRole('dinfo')) {
            $rules['document'] .= '|max:9216';
        }

        $document = Document::where('uuid', $uuid)->first();

        if ($document) {
            $document->title = $request->title;
            $document->description =  $request->description;
            $document->year =  $request->year;
            $document->year_end = $request->year_end;
            $document->type =  $request->type;
            $document->user_updated_id =  auth()->user()->id;
            $document->save();
        }


        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $name = $document->id . ".pdf";
            $request->document->storeAs('documents/general', $name);
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $name = $document->id . ".jpg";
            $request->thumbnail->storeAs('clube', $name);
        }

        return redirect()->route('manager.document.general.update', [$type, $document->uuid])
            ->with('success', 'Documento Atualizado com Sucesso');
    }

    public function delete($type, $uuid)
    {
        if ($this->checkType($type)) {
            $document = Document::where('uuid', $uuid)->first();
            return view('manager.modules.document-general.delete', compact('type', 'document'));
        }

        return redirect()->route('manager.document.general.list', $type)
            ->with('error', 'Documento Não encontrado');
    }

    public function destroy($type, Request $request)
    {

        $request->validate([
            'uuid' => 'required',
        ]);

        $document = Document::where('uuid', $request->uuid)->first();

        if ($document) {
            $document->delete();
        }


        return redirect()->route('manager.document.general.list', $type)
            ->with('success', 'Documento Removido com Sucesso');
    }

    public function destroyImage($type, Request $request)
    {

        $request->validate([
            'uuid' => 'required',
        ]);

        $document = Document::where('uuid', $request->uuid)->first();

        if ($document) {
            $relativePath = "clube/{$document->id}.jpg";

            if (Storage::exists($relativePath)) {
                Storage::delete($relativePath);
            }
        }

        return redirect()->route('manager.document.general.list', $type)
            ->with('success', 'Imagem Removida com Sucesso');
    }
}
