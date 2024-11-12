<?php

namespace Database\Seeders;


use App\Enums\Roles;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        User::withoutEvents(function () {
            $this->CreateUser(Roles::ROOT->value);
            $this->CreateUser(Roles::ADMINISTRATOR->value);
            $this->CreateUser(Roles::USER->value);
        });
    }

    /**
     * @param string $role
     * @return void
     * @throws Exception
     */
    private function CreateUser(string $role): void
    {
        $faker = \Faker\Factory::create();
        User::create([
            'email' => Str::lower($role) . '@' . Str::snake(Str::lower(config('app.name', 'budget-plan')), '-') . '.com',
            'password' => '123456',
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
        ])->assignRole($role);
    }
}
