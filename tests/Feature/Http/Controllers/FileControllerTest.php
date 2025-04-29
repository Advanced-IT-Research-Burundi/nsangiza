<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FileController
 */
final class FileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $files = File::factory()->count(3)->create();

        $response = $this->get(route('files.index'));

        $response->assertOk();
        $response->assertViewIs('file.index');
        $response->assertViewHas('files');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('files.create'));

        $response->assertOk();
        $response->assertViewIs('file.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FileController::class,
            'store',
            \App\Http\Requests\FileStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $name = fake()->name();
        $path = fake()->word();
        $type = fake()->word();
        $size = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('files.store'), [
            'user_id' => $user->id,
            'name' => $name,
            'path' => $path,
            'type' => $type,
            'size' => $size,
        ]);

        $files = File::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->where('path', $path)
            ->where('type', $type)
            ->where('size', $size)
            ->get();
        $this->assertCount(1, $files);
        $file = $files->first();

        $response->assertRedirect(route('files.index'));
        $response->assertSessionHas('file.id', $file->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $file = File::factory()->create();

        $response = $this->get(route('files.show', $file));

        $response->assertOk();
        $response->assertViewIs('file.show');
        $response->assertViewHas('file');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $file = File::factory()->create();

        $response = $this->get(route('files.edit', $file));

        $response->assertOk();
        $response->assertViewIs('file.edit');
        $response->assertViewHas('file');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FileController::class,
            'update',
            \App\Http\Requests\FileUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $file = File::factory()->create();
        $user = User::factory()->create();
        $name = fake()->name();
        $path = fake()->word();
        $type = fake()->word();
        $size = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('files.update', $file), [
            'user_id' => $user->id,
            'name' => $name,
            'path' => $path,
            'type' => $type,
            'size' => $size,
        ]);

        $file->refresh();

        $response->assertRedirect(route('files.index'));
        $response->assertSessionHas('file.id', $file->id);

        $this->assertEquals($user->id, $file->user_id);
        $this->assertEquals($name, $file->name);
        $this->assertEquals($path, $file->path);
        $this->assertEquals($type, $file->type);
        $this->assertEquals($size, $file->size);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $file = File::factory()->create();

        $response = $this->delete(route('files.destroy', $file));

        $response->assertRedirect(route('files.index'));

        $this->assertModelMissing($file);
    }
}
