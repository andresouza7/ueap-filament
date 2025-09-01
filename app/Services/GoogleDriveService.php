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
        $client->setAuthConfig(storage_path('app/google/credentials2.json'));
        $client->addScope(GoogleDrive::DRIVE);
        $client->addScope(GoogleDrive::DRIVE_FILE);
        $client->addScope(GoogleDrive::DRIVE_APPDATA);

        $this->drive = new GoogleDrive($client);
    }

    public function upload(File $file, string $folderId): DriveFile
    {
        $fileMetadata = new DriveFile([
            'name' => $file->getFilename(),
            'parents' => [$folderId],
        ]);

        $content = file_get_contents($file->getRealPath());
        $mimeType = mime_content_type($file->getRealPath());

        return $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id,name,webViewLink,webContentLink,capabilities',
            'supportsAllDrives' => true,
        ]);
    }

    public function listFiles(string $folderId): array
    {
        $response = $this->drive->files->listFiles([
            'q' => "'$folderId' in parents and trashed = false",
            'fields' => 'files(id,name,mimeType,webViewLink,webContentLink,parents)',
            'supportsAllDrives' => true,
            'includeItemsFromAllDrives' => true,
        ]);

        return $response->files;
    }


    public function deleteFile(string $fileId): bool
    {
        try {
            $this->drive->files->delete($fileId, [
                'supportsAllDrives' => true,
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao deletar arquivo do Google Drive: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Cria (ou recupera) uma pasta pelo nome dentro de um parentId
     */
    protected function getOrCreateFolder(string $folderName, ?string $parentId = null): string
    {
        $query = "mimeType='application/vnd.google-apps.folder' and name='$folderName' and trashed=false";
        if ($parentId) {
            $query .= " and '$parentId' in parents";
        }

        $response = $this->drive->files->listFiles([
            'q' => $query,
            'fields' => 'files(id,name)',
            'supportsAllDrives' => true,
            'includeItemsFromAllDrives' => true,
        ]);

        if (count($response->files) > 0) {
            return $response->files[0]->id;
        }

        // Criar nova pasta
        $folderMetadata = new DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);

        if ($parentId) {
            $folderMetadata->setParents([$parentId]);
        }

        $folder = $this->drive->files->create($folderMetadata, [
            'fields' => 'id',
            'supportsAllDrives' => true,
        ]);

        return $folder->id;
    }

    /**
     * Upload do arquivo de frequência dentro da estrutura Ano -> Usuário
     */
    public function uploadAttendanceFile($file, string $year, string $monthName, \App\Models\User $user): DriveFile
    {
        $userName = $user->person->name;

        // 1️⃣ Cria ou obtém a pasta do ano
        $yearFolderId = $this->getOrCreateFolder($year, env('GOOGLE_DRIVE_FOLDER_ID'));

        // 2️⃣ Cria ou obtém a pasta do usuário dentro do ano
        $userFolderId = $this->getOrCreateFolder($userName, $yearFolderId);

        // 3️⃣ Define o nome do arquivo como o nome do mês em português + extensão
        $extension = $file->getClientOriginalExtension();
        $newFileName = $monthName . ($extension ? '.' . $extension : '');

        // 4️⃣ Faz upload do arquivo com o novo nome
        $fileMetadata = new DriveFile([
            'name' => $newFileName,
            'parents' => [$userFolderId],
        ]);

        $content = file_get_contents($file->getRealPath());
        $mimeType = mime_content_type($file->getRealPath());

        return $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id,name,webViewLink,webContentLink,capabilities',
            'supportsAllDrives' => true,
        ]);
    }
}
