<?php

namespace database\seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    const ADMIN_EMAIL = 'admin@admin.com';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', self::ADMIN_EMAIL)->exists()) {
            (User::factory()->withEmail(self::ADMIN_EMAIL)->create())
                ->syncRoles(Roles::ADMIN->value);
        }

        User::factory(5)->create();
    }
}
