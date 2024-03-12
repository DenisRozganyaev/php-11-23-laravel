<?php

namespace Tests\Feature\Admin;

use App\Enums\Roles;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\PermissionAndRolesSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_allow_see_categories_with_role_admin()
    {
        $categories = Category::factory(2)->create();
        $response = $this->actingAs($this->getUser())
            ->get(route('admin.categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('admin.categories.index');
        $response->assertSeeInOrder($categories->pluck('name')->toArray());
    }

    public function test_does_not_allow_see_categories_with_role_customer()
    {
        $response = $this->actingAs($this->getUser(Roles::CUSTOMER))
            ->get(
                route('admin.categories.index')
            );

        $response->assertStatus(403);
    }

    public function test_create_category_with_valid_data()
    {
        $data = Category::factory()->make()->toArray();

        $response = $this->actingAs($this->getUser())
            ->post(route('admin.categories.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.categories.index');
        $this->assertDatabaseHas(Category::class, [
            'name' => $data['name'],
        ]);
    }

    public function test_create_category_with_invalid_data()
    {
        $data = ['name' => 'a'];

        $response = $this->actingAs($this->getUser())
            ->post(route('admin.categories.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name' => 'Should be more than 1 symbol']);
        $this->assertDatabaseMissing(Category::class, [
            'name' => $data['name'],
        ]);
    }

    public function test_update_category_with_valid_data()
    {
        $category = Category::factory()->create();
        $parent = Category::factory()->create();

        $response = $this->actingAs($this->getUser())
            ->put(route('admin.categories.update', $category), [
                'name' => $category->name,
                'parent_id' => $parent->id,
            ]);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.categories.edit', compact('category'));

        $category->refresh();

        $this->assertEquals($category->parent_id, $parent->id);
    }

    public function test_remove_category()
    {
        $category = Category::factory()->create();

        $this->assertDatabaseHas(Category::class, [
            'id' => $category->id,
        ]);

        $response = $this->actingAs($this->getUser())
            ->delete(route('admin.categories.destroy', $category));

        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.categories.index');

        $this->assertDatabaseMissing(Category::class, [
            'id' => $category->id,
        ]);
    }

    protected function getUser(Roles $role = Roles::ADMIN): User
    {
        return User::role($role->value)->firstOrFail();
    }
}
