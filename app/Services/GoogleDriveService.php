<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;

class GoogleDriveService
{
    public GoogleDrive $drive;

    public function __construct()
    {
        $client = new GoogleClient();
        // Carrega o JSON da Service Account
        $client->setAuthConfig(storage_path('app/google/credentials2.json'));
        $client->addScope(GoogleDrive::DRIVE);
        $client->addScope(GoogleDrive::DRIVE_FILE);
        $client->addScope(GoogleDrive::DRIVE_APPDATA);

        $this->drive = new GoogleDrive($client);
    }

    /**
     * Faz upload de um PDF para uma pasta dentro de um Shared Drive
     *
     * @param File $file          Arquivo local
     * @param string $folderId    ID da pasta dentro do Shared Drive
     * @return DriveFile
     */
    public function upload(File $file, string $folderId): DriveFile
    {
        // 1️⃣ Metadados do arquivo
        $fileMetadata = new DriveFile([
            'name' => $file->getFilename(),   // Nome do arquivo no Drive
            'parents' => [$folderId],         // ID da pasta no Shared Drive
        ]);

        // 2️⃣ Conteúdo do arquivo local
        $content = file_get_contents($file->getRealPath());

        // 3️⃣ Detectar MIME type dinamicamente
        $mimeType = mime_content_type($file->getRealPath());
        // ou: $mimeType = $file->getMimeType();  // também funciona no Illuminate\Http\File

        // 4️⃣ Criar arquivo no Drive
        $uploadedFile = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id,name,webViewLink,webContentLink,capabilities',
            'supportsAllDrives' => true,
        ]);

        return $uploadedFile;
    }

    /**
     * Lista arquivos de uma pasta do Shared Drive (opcional)
     *
     * @param string $folderId
     * @return array
     */
    public function listFiles(string $folderId): array
    {
        $response = $this->drive->files->listFiles([
            'q' => "'$folderId' in parents and trashed = false",
            'fields' => 'files(id,name,webViewLink,webContentLink)',
            'supportsAllDrives' => true,         // importante
            'includeItemsFromAllDrives' => true, // incluir Shared Drives
        ]);

        return $response->files;
    }

    /**
     * Remove um arquivo do Google Drive / Shared Drive
     *
     * @param string $fileId
     * @return bool
     */
    public function deleteFile(string $fileId): bool
    {
        try {
            $this->drive->files->delete($fileId, [
                'supportsAllDrives' => true, // necessário p/ Shared Drives
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao deletar arquivo do Google Drive: ' . $e->getMessage());
            return false;
        }
    }
}
