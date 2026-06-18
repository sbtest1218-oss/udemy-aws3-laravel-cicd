<?php

namespace Tests\Feature;

use App\Models\Milestone;
use Database\Seeders\MilestoneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_トップページが正常に表示される(): void
    {
        $this->seed(MilestoneSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('本当によく頑張ったね');
    }

    public function test_全フェーズの章が表示される(): void
    {
        $this->seed(MilestoneSeeder::class);

        $response = $this->get('/');

        $response->assertSee('TDD編', false);
        $response->assertSee('AIコーディング編', false);
        $response->assertSee('CI/CD編', false);
        $response->assertSee('自動デプロイ', false);
    }

    public function test_シーダーで全マイルストーンが投入される(): void
    {
        $this->seed(MilestoneSeeder::class);

        $this->assertSame(13, Milestone::count());
        $this->assertSame(1, Milestone::where('is_final', true)->count());
    }

    public function test_シーダーは冪等である(): void
    {
        $this->seed(MilestoneSeeder::class);
        $this->seed(MilestoneSeeder::class);

        $this->assertSame(13, Milestone::count());
    }
}
