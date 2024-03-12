<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use App\Services\FileStorageService;
use Database\Seeders\PermissionAndRolesSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    protected function afterRefreshingDatabase()
    {
        $this->seed(PermissionAndRolesSeeder::class);
        $this->seed(UsersSeeder::class);
    }

    public function test_create_product(): void
    {
        $file = UploadedFile::fake()->image('test_image.png');
        $data = array_merge(
            Product::factory()->make()->toArray(),
            ['thumbnail' => $file]
        );

        $this->mock(
            FileStorageService::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('upload')
                    ->andReturn('image_uploaded.png');
            }
        );

        $this->actingAs(User::role('admin')->first())
            ->post(route('admin.products.store'), $data);


        $this->assertDatabaseHas(Product::class, [
            'title' => $data['title'],
            'thumbnail' => 'image_uploaded.png'
        ]);
    }
}
