<?php

namespace Tests\Unit;

use App\Services\FolhaPontoService;
use App\Services\GoogleDriveService;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
use Google\Service\Drive\DriveFile;


class FolhaPontoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected FolhaPontoService $service;
    protected $driveMock;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('2025-05-15'); // Maio de 2025
        
        $this->driveMock = Mockery::mock(GoogleDriveService::class);
        $this->service = new FolhaPontoService($this->driveMock);
    }

    public function test_get_pending_sheets_returns_correct_months()
    {
        $user = User::factory()->create();

        // Criar tickets aprovados em janeiro e março
        Ticket::factory()->create([
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 1,
            'status' => 'aprovado'
        ]);

        Ticket::factory()->create([
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 3,
            'status' => 'aprovado'
        ]);

        $pending = $this->service->getPendingSheets($user);

        $this->assertEquals([
            'fevereiro',
            'abril'
        ], $pending);
    }

    public function test_has_pending_sheets_returns_true_and_false()
    {
        $user = User::factory()->create();

        $this->assertTrue($this->service->hasPendingSheets($user));

        // preencher tudo até abril
        foreach ([1,2,3,4] as $m) {
            Ticket::factory()->create([
                'user_id' => $user->id,
                'year' => 2025,
                'month' => $m,
                'status' => 'aprovado'
            ]);
        }

        $this->assertFalse($this->service->hasPendingSheets($user));
    }

    public function test_is_month_pending()
    {
        $user = User::factory()->create();

        Ticket::factory()->create([
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 2,
            'status' => 'aprovado'
        ]);

        $this->assertFalse($this->service->isMonthPending($user, 2));
        $this->assertTrue($this->service->isMonthPending($user, 3));
    }

    public function test_submit_sheet_creates_ticket_and_uploads_file()
    {
        $user = User::factory()->create();

        $this->driveMock
            ->shouldReceive('getOrCreateFolder')
            ->once()
            ->andReturn('temp-folder');

        $this->driveMock
            ->shouldReceive('upload')
            ->once()
            ->andReturn(new DriveFile([
                'id' => 'FILE123',
                'name' => 'tempfile.txt',
                'webViewLink' => 'https://drive/link'
            ]));

        // Criar arquivo temporário real
        $tmp = tmpfile();
        fwrite($tmp, "abc");
        $path = stream_get_meta_data($tmp)['uri'];

        // Converter para Illuminate\Http\File
        $file = new \Illuminate\Http\File($path);

        $ticket = $this->service->submitSheet(
            user: $user,
            year: 2025,
            month: 5,
            notes: 'Teste',
            file: $file
        );

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 5,
            'status' => 'pendente'
        ]);
    }

    public function test_submit_sheet_throws_exception_if_ticket_already_approved()
    {
        $user = User::factory()->create();

        Ticket::factory()->create([
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 5,
            'status' => 'aprovado'
        ]);

        $this->expectException(\Exception::class);

        $this->service->submitSheet(
            user: $user,
            year: 2025,
            month: 5,
            notes: 'Teste',
            file: tmpfile()
        );
    }

    public function test_evaluate_ticket_approves_and_moves_file()
    {
        $user = User::factory()->hasPerson()->create();

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'year' => 2025,
            'month' => 4,
            'file_id' => 'FILE123',
            'status' => 'pendente'
        ]);

        $this->driveMock
            ->shouldReceive('getOrCreateFolder')
            ->twice()
            ->andReturn('year-folder', 'user-folder');

        $this->driveMock
            ->shouldReceive('moveFileById')
            ->once()
            ->with('FILE123', 'user-folder', 'abril');

        $updated = $this->service->evaluateTicket($ticket, 'aprovado', 'ok');

        $this->assertEquals('aprovado', $updated->status);
        $this->assertNotNull($updated->evaluated_at);
    }
}
