<?php

namespace Tests\Unit;

use App\Services\GoogleDriveService;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\File;
use Mockery;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class GoogleDriveServiceTest extends TestCase
{
    protected $googleMock;
    protected $filesMock;
    protected GoogleDriveService $service;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock drive
        $this->googleMock = Mockery::mock(GoogleDrive::class);
        $this->filesMock = Mockery::mock();

        // "files" property da API
        $this->googleMock->files = $this->filesMock;

        // Instancia serviço, mas substitui o $drive
        $this->service = new GoogleDriveService();
        $this->service->drive = $this->googleMock;
    }

    public function test_list_files()
    {
        $this->filesMock
            ->shouldReceive('listFiles')
            ->once()
            ->andReturn((object)[
                'files' => [
                    (object)['id' => '1', 'name' => 'abc.txt'],
                    (object)['id' => '2', 'name' => 'xyz.png'],
                ]
            ]);

        $result = $this->service->listFiles('FOLDER123');

        $this->assertCount(2, $result);
        $this->assertEquals('abc.txt', $result[0]->name);
    }

    public function test_delete_file_success()
    {
        $this->filesMock
            ->shouldReceive('delete')
            ->once()
            ->with('FILE123', Mockery::type('array'))
            ->andReturnTrue();

        $this->assertTrue($this->service->deleteFile('FILE123'));
    }

    public function test_delete_file_failure_returns_false()
    {
        Log::shouldReceive('error')->once();

        $this->filesMock
            ->shouldReceive('delete')
            ->once()
            ->andThrow(new \Exception('Falha'));

        $this->assertFalse($this->service->deleteFile('FILE123'));
    }

    public function test_get_or_create_folder_returns_existing_folder()
    {
        $this->filesMock
            ->shouldReceive('listFiles')
            ->once()
            ->andReturn((object)[
                'files' => [(object)['id' => 'EXIST123', 'name' => 'Uploads']]
            ]);

        $result = $this->service->getOrCreateFolder('Uploads');

        $this->assertEquals('EXIST123', $result);
    }

    public function test_get_or_create_folder_creates_new_folder()
    {
        $this->filesMock
            ->shouldReceive('listFiles')
            ->once()
            ->andReturn((object)['files' => []]);

        $this->filesMock
            ->shouldReceive('create')
            ->once()
            ->andReturn((object)['id' => 'NEWFOLDER']);

        $id = $this->service->getOrCreateFolder('Uploads');

        $this->assertEquals('NEWFOLDER', $id);
    }

    public function test_move_file_by_id()
    {
        // Primeiro: get() → retorna pais antigos
        $this->filesMock
            ->shouldReceive('get')
            ->once()
            ->with('FILE999', Mockery::type('array'))
            ->andReturn((object)[
                'parents' => ['OLDPARENT']
            ]);

        // Depois: update()
        $this->filesMock
        ->shouldReceive('update')
        ->once()
        ->with(
            'FILE999',
            Mockery::type(DriveFile::class),
            Mockery::on(function ($params) {
                return $params['addParents'] === 'NEWPARENT'
                    && $params['removeParents'] === 'OLDPARENT';
            })
        )
        ->andReturn(new DriveFile([
            'id' => 'FILE999',
            'name' => 'Renomeado',
            'parents' => ['NEWPARENT'],
        ]));

        $updated = $this->service->moveFileById('FILE999', 'NEWPARENT', 'Renomeado');

        $this->assertEquals('FILE999', $updated->id);
        $this->assertEquals('Renomeado', $updated->name);
    }

    public function test_upload_file_with_tmpfile()
    {
        // 🔧 1. Criar arquivo temporário real
        $tmp = tmpfile();
        $path = stream_get_meta_data($tmp)['uri'];

        // escrever dados no arquivo
        fwrite($tmp, "conteudo de teste");

        // Criar instância File do Laravel
        $file = new \Illuminate\Http\File($path);

        // 🔧 2. Mock da resposta da API Google Drive
        $this->filesMock
        ->shouldReceive('create')
        ->once()
        ->with(
            Mockery::type(\Google\Service\Drive\DriveFile::class),
            Mockery::on(function ($params) use ($path) {
                return $params['data'] === file_get_contents($path)
                    && $params['mimeType'] === mime_content_type($path)
                    && $params['uploadType'] === 'multipart'
                    && $params['supportsAllDrives'] === true;
            })
        )
        ->andReturn(new \Google\Service\Drive\DriveFile([
            'id' => 'FILE123',
            'name' => basename($path),
            'webViewLink' => 'https://example.com/view',
            'webContentLink' => 'https://example.com/download',
        ]));


        // 🔧 3. Executar método
        $uploaded = $this->service->upload($file, 'FOLDER999');

        // 📌 4. Asserções
        $this->assertEquals('FILE123', $uploaded->id);
        $this->assertEquals(basename($path), $uploaded->name);
        $this->assertEquals('https://example.com/view', $uploaded->webViewLink);
    }

}
