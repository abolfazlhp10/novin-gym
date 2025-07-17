<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Enums\RoleEnum;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrcreate(['name' => RoleEnum::ADMIN , 'guard_name'=>'api']);

        Role::updateOrCreate(['name' => RoleEnum::COACH , 'guard_name'=>'api']);
    }
}
