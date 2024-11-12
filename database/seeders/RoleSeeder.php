<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Roles::cases() as $item) {
            Role::create([
                'id' => Str::uuid(),
                'name' => $item->value
            ]);
        }
    }
}
