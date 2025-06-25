<?php

namespace Tests\Feature;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_job()
    {
        // Cria employer + user relacionado
        $employer = Employer::factory()->create();
        $user = $employer->user;

        $tag = Tag::factory()->create();

        $data = [
            'title' => 'Desenvolvedor Laravel',
            'salary' => '5000',
            'location' => 'Remoto',
            'schedule' => 'Full Time',
            'url' => 'https://example.com/job/1',
            'featured' => false,
            'tags' => $tag->name,
        ];

        // Autentica o usuário
        $response = $this->actingAs($user)->post('/jobs', $data);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('jobs', [
            'title' => 'Desenvolvedor Laravel',
            'employer_id' => $employer->id,
        ]);

        $this->assertDatabaseHas('job_tag', [
            'tag_id' => $tag->id,
        ]);
    }

    public function test_user_can_update_job()
    {
        $employer = Employer::factory()->create();
        $user = $employer->user;

        $tag = Tag::factory()->create();

        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        $data = [
            'title' => 'Atualizado',
            'salary' => '6000',
            'location' => 'Presencial',
            'schedule' => 'Full Time',
            'url' => 'https://example.com/job/updated',
            'featured' => true,
            'tags' => $tag->name,
        ];

        $response = $this->actingAs($user)->put("/jobs/{$job->id}", $data);

        $response->assertRedirect(route('my-jobs'));

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => 'Atualizado',
            'employer_id' => $employer->id,
        ]);

        $this->assertDatabaseHas('job_tag', [
            'tag_id' => $tag->id,
        ]);
    }

    public function test_user_can_delete_job()
    {
        $employer = Employer::factory()->create();
        $user = $employer->user;

        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        $response = $this->actingAs($user)->delete("/jobs/{$job->id}");

        $response->assertRedirect(route('my-jobs'));

        $this->assertDatabaseMissing('jobs', [
            'id' => $job->id,
        ]);
    }
}
