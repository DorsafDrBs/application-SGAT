<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 1, 'name' => 'role-list'],
            ['id' => 2, 'name' => 'role-create'],
            ['id' => 3, 'name' => 'role-edit'],
            ['id' => 4, 'name' => 'role-delete'],
            ['id' => 5, 'name' => 'process-list'],
            ['id' => 6, 'name' => 'process-create'],
            ['id' => 7, 'name' => 'process-edit'],
            ['id' => 8, 'name' => 'process-delete'],
            ['id' => 9, 'name' => 'home-index'],
            ['id' => 10, 'name' => 'project-list'],
            ['id' => 11, 'name' => 'project-create'],
            ['id' => 12, 'name' => 'project-edit'],
            ['id' => 13, 'name' => 'project-delete'],
            ['id' => 14, 'name' => 'manager'],
            ['id' => 15, 'name' => 'indic-proc-list'],
            ['id' => 16, 'name' => 'indic-proc-create'],
            ['id' => 17, 'name' => 'indic-proc-edit'],
            ['id' => 18, 'name' => 'indic-proc-delete'],
            ['id' => 19, 'name' => 'indic-proj-list'],
            ['id' => 20, 'name' => 'indic-proj-create'],
            ['id' => 21, 'name' => 'indic-proj-edit'],
            ['id' => 22, 'name' => 'indic-proj-delete'],
            ['id' => 23, 'name' => 'indic-user-list'],
            ['id' => 24, 'name' => 'indic-user-create'],
            ['id' => 25, 'name' => 'indic-user-edit'],
            ['id' => 26, 'name' => 'indic-user-delete'],
            
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::updateOrCreate(['name' => $permission['name']],$permission);
         }
    }
}
