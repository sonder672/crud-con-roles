<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //Roles
            'showRol', 
            'createRol',
            'editRol',
            'deleteRol',
            //Notes
            'showNote', 
            'createNote',
            'editNote',
            'deleteNote',
            //Users
            'showUser',
            'CreateUser',
            'editUser',
            'deleteUser'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
