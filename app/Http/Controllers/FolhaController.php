<?php

namespace App\Http\Controllers;

use App\Models\Folha;
use Illuminate\Http\File;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolhaController extends Controller
{
    protected GoogleDriveService $drive;

    public function __construct(GoogleDriveService $drive)
    {
        // $this->middleware('auth');
        $this->drive = $drive;
    }

    public function index()
    {


        $folhas = $this->drive->listFiles(env('GOOGLE_DRIVE_FOLDER_ID'));
        // dd($folhas);
        // $folhas = Folha::with('user')->latest()->get();
        return view('folhas.index', compact('folhas'));
    }

    public function create()
    {
        return view('folhas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo' => 'required',
        ]);

        // return dd($request->arquivo);

        //$file = $this->drive->uploadPdf($request->file('arquivo'), env('GOOGLE_DRIVE_FOLDER_ID'));


        $uploadedFile = $request->file('arquivo'); // UploadedFile
        $pdfFile = new File($uploadedFile->getRealPath()); // converte para Illuminate\Http\File

        $file = $this->drive->upload($pdfFile, env('GOOGLE_DRIVE_FOLDER_ID'));


        // Folha::create([
        //     'user_id' => Auth::id(),
        //     'original_name' => $file->name,
        //     'drive_file_id' => $file->id,
        //     'drive_web_view_link' => $file->webViewLink,
        //     'drive_web_content_link' => $file->webContentLink,
        // ]);

        return redirect()->route('folhas.index')->with('success', 'Folha enviada com sucesso!');
    }

    public function destroy(string $id)
    {
        if ($this->drive->deleteFile($id)) {
            return redirect()->back()->with('success', 'Arquivo removido com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao remover arquivo.');
    }
}
