<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\File;
use App\Models\SharedBy;
use App\Models\SharedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SharedFileController
 */
final class SharedFileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sharedFiles = SharedFile::factory()->count(3)->create();

        $response = $this->get(route('shared-files.index'));

        $response->assertOk();
        $response->assertViewIs('sharedFile.index');
        $response->assertViewHas('sharedFiles');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('shared-files.create'));

        $response->assertOk();
        $response->assertViewIs('sharedFile.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SharedFileController::class,
            'store',
            \App\Http\Requests\SharedFileStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $file = File::factory()->create();
        $shared_by = SharedBy::factory()->create();
        $access_level = fake()->word();

        $response = $this->post(route('shared-files.store'), [
            'file_id' => $file->id,
            'shared_by' => $shared_by->id,
            'access_level' => $access_level,
        ]);

        $sharedFiles = SharedFile::query()
            ->where('file_id', $file->id)
            ->where('shared_by', $shared_by->id)
            ->where('access_level', $access_level)
            ->get();
        $this->assertCount(1, $sharedFiles);
        $sharedFile = $sharedFiles->first();

        $response->assertRedirect(route('sharedFiles.index'));
        $response->assertSessionHas('sharedFile.id', $sharedFile->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $sharedFile = SharedFile::factory()->create();

        $response = $this->get(route('shared-files.show', $sharedFile));

        $response->assertOk();
        $response->assertViewIs('sharedFile.show');
        $response->assertViewHas('sharedFile');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $sharedFile = SharedFile::factory()->create();

        $response = $this->get(route('shared-files.edit', $sharedFile));

        $response->assertOk();
        $response->assertViewIs('sharedFile.edit');
        $response->assertViewHas('sharedFile');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SharedFileController::class,
            'update',
            \App\Http\Requests\SharedFileUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $sharedFile = SharedFile::factory()->create();
        $file = File::factory()->create();
        $shared_by = SharedBy::factory()->create();
        $access_level = fake()->word();

        $response = $this->put(route('shared-files.update', $sharedFile), [
            'file_id' => $file->id,
            'shared_by' => $shared_by->id,
            'access_level' => $access_level,
        ]);

        $sharedFile->refresh();

        $response->assertRedirect(route('sharedFiles.index'));
        $response->assertSessionHas('sharedFile.id', $sharedFile->id);

        $this->assertEquals($file->id, $sharedFile->file_id);
        $this->assertEquals($shared_by->id, $sharedFile->shared_by);
        $this->assertEquals($access_level, $sharedFile->access_level);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $sharedFile = SharedFile::factory()->create();

        $response = $this->delete(route('shared-files.destroy', $sharedFile));

        $response->assertRedirect(route('sharedFiles.index'));

        $this->assertModelMissing($sharedFile);
    }
}
