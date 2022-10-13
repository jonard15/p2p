<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if (DB::table('users')->count() == 0) {
            $password = Hash::make('password');
            $users = DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => $password,
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        if (DB::table('roles')->count() == 0) {
                # Roles
                $rolesData = [
                    [
                        'created_at' => date('Y-m-d H:i:s'),
                        'role_ref' => 'SA11665626395',
                        'roleName' => 'Super Admin',
                        'permission' => '[{"menu_id":1,"title":"Dashboard","path":"","icon":"mdi-view-dashboard","color":"#004D40FF","parent_id":0,"isActive":1,"sorting":0,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:47:15.000000Z","updated_at":"2022-10-13T01:47:15.000000Z"},{"menu_id":2,"title":"Dashboard v1","path":"dashboard","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":1,"isActive":1,"sorting":1,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:48:14.000000Z","updated_at":"2022-10-13T01:48:14.000000Z"},{"menu_id":3,"title":"Settings","path":"","icon":"mdi-cogs","color":"#1976D2FF","parent_id":0,"isActive":1,"sorting":2,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:49:03.000000Z","updated_at":"2022-10-13T01:49:03.000000Z"},{"menu_id":4,"title":"Users","path":"users","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":3,"isActive":1,"sorting":3,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:49:49.000000Z","updated_at":"2022-10-13T01:49:49.000000Z"},{"menu_id":5,"title":"Roles","path":"roles","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":3,"isActive":1,"sorting":4,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:50:25.000000Z","updated_at":"2022-10-13T01:50:25.000000Z"},{"menu_id":6,"title":"Permissions","path":"permissions","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":3,"isActive":1,"sorting":5,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:50:47.000000Z","updated_at":"2022-10-13T01:50:47.000000Z"},{"menu_id":7,"title":"Menus","path":"menus","icon":"mdi-checkbox-blank-circle-outline","color":null,"parent_id":3,"isActive":1,"sorting":6,"is_read":1,"is_create":1,"is_edit":1,"is_delete":1,"created_at":"2022-10-13T01:51:04.000000Z","updated_at":"2022-10-13T01:51:04.000000Z"}]'
                    ],

                ];
        
                DB::table('roles')->insert($rolesData);
                # Roles
        }

        if (DB::table('menus')->count() == 0) {
            # Menus
            $menusData = [
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Dashboard',
                    'path' => '',
                    'icon' => 'mdi-view-dashboard',
                    'color' => '#004D40FF',
                    'parent_id' => 0,
                    'sorting' => 0,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Dashboard V1',
                    'path' => 'dashboard',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 1,
                    'sorting' => 1,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Settings',
                    'path' => '#1976D2FF',
                    'icon' => 'mdi-cog',
                    'color' => '#004D40FF',
                    'parent_id' => 0,
                    'sorting' => 2,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Users',
                    'path' => 'users',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 3,
                    'sorting' => 3,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Roles',
                    'path' => 'roles',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 3,
                    'sorting' => 4,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Permissions',
                    'path' => 'permissions',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 3,
                    'sorting' => 5,
                    'isActive' => 1
                    
                ],
                [
                    'created_at' => date('Y-m-d H:i:s'),
                    'title' => 'Menus',
                    'path' => 'menus',
                    'icon' => 'mdi-checkbox-blank-circle-outline',
                    'color' => '',
                    'parent_id' => 3,
                    'sorting' => 6,
                    'isActive' => 1
                    
                ],

            ];
    
            DB::table('menus')->insert($menusData);
            # Menus
    }
    }
}
