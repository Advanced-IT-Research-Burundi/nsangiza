<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\File;
use App\Models\FileActivity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FileActivityController
 */
final class FileActivityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $fileActivities = FileActivity::factory()->count(3)->create();

        $response = $this->get(route('file-activities.index'));

        $response->assertOk();
        $response->assertViewIs('fileActivity.index');
        $response->assertViewHas('fileActivities');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('file-activities.create'));

        $response->assertOk();
        $response->assertViewIs('fileActivity.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FileActivityController::class,
            'store',
            \App\Http\Requests\FileActivityStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $file = File::factory()->create();
        $user = User::factory()->create();
        $action = fake()->word();
        $details = fake()->word();

        $response = $this->post(route('file-activities.store'), [
            'file_id' => $file->id,
            'user_id' => $user->id,
            'action' => $action,
            'details' => $details,
        ]);

        $fileActivities = FileActivity::query()
            ->where('file_id', $file->id)
            ->where('user_id', $user->id)
            ->where('action', $action)
            ->where('details', $details)
            ->get();
        $this->assertCount(1, $fileActivities);
        $fileActivity = $fileActivities->first();

        $response->assertRedirect(route('fileActivities.index'));
        $response->assertSessionHas('fileActivity.id', $fileActivity->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $fileActivity = FileActivity::factory()->create();

        $response = $this->get(route('file-activities.show', $fileActivity));

        $response->assertOk();
        $response->assertViewIs('fileActivity.show');
        $response->assertViewHas('fileActivity');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $fileActivity = FileActivity::factory()->create();

        $response = $this->get(route('file-activities.edit', $fileActivity));

        $response->assertOk();
        $response->assertViewIs('fileActivity.edit');
        $response->assertViewHas('fileActivity');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FileActivityController::class,
            'update',
            \App\Http\Requests\FileActivityUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $fileActivity = FileActivity::factory()->create();
        $file = File::factory()->create();
        $user = User::factory()->create();
        $action = fake()->word();
        $details = fake()->word();

        $response = $this->put(route('file-activities.update', $fileActivity), [
            'file_id' => $file->id,
            'user_id' => $user->id,
            'action' => $action,
            'details' => $details,
        ]);

        $fileActivity->refresh();

        $response->assertRedirect(route('fileActivities.index'));
        $response->assertSessionHas('fileActivity.id', $fileActivity->id);

        $this->assertEquals($file->id, $fileActivity->file_id);
        $this->assertEquals($user->id, $fileActivity->user_id);
        $this->assertEquals($action, $fileActivity->action);
        $this->assertEquals($details, $fileActivity->details);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $fileActivity = FileActivity::factory()->create();

        $response = $this->delete(route('file-activities.destroy', $fileActivity));

        $response->assertRedirect(route('fileActivities.index'));

        $this->assertModelMissing($fileActivity);
    }
}
