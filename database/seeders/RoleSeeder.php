<?php

namespace Database\Seeders;

use App\Core\Services\UuidGeneratorService;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->create(
            [
                //'id' => UuidGeneratorService::getUUIDUnique(Role::class, 'id'),
                'name' => 'super-admin',
                'alias_name' => 'Super Admin',
            ]
        );
        Role::query()->create(
            [
                //'id' => UuidGeneratorService::getUUIDUnique(Role::class, 'id'),
                'name' => 'admin',
                'alias_name' => 'Administrador',
            ]
        );
        Role::query()->create(
            [
                //'id' => UuidGeneratorService::getUUIDUnique(Role::class, 'id'),
                'name' => 'student',
                'alias_name' => 'Estudiante',
            ]
        );
    }
}
