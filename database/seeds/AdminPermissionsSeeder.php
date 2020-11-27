<?php

use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'      => 'All permission',
                'slug'      => '*',
                'method'    => '',
                'path'      => '/api/admin/*',
                'read_only' => 1
            ],
            [
                'name'      => 'Dashboard',
                'slug'      => 'dashboard',
                'method'    => 'GET',
                'path'      => '/api/admin',
                'read_only' => 1
            ],
            [
                'name'      => 'RP Management',
                'slug'      => 'rp.management',
                'method'    => '',
                'path'      => "/api/admin/roles\r\n/api/admin/permissions\r\n",
                'read_only' => 1
            ],
            [
                'name'      => 'Admin Management',
                'slug'      => 'admin.management',
                'method'    => '',
                'path'      => "/api/admin/admins\r\n/api/admin/admin_groups\r\n/api/admin/vendors\r\n",
                'read_only' => 1
            ],
            [
                'name'      => 'Home',
                'slug'      => 'index',
                'method'    => 'GET',
                'path'      => '/',
                'read_only' => 1
            ],
        ];
        
        DB::table('permissions')->insert($permissions);
    }
}
