<?php

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
        $permissions = [
            'AdminiStrator' => ['*'],
            'ManageUser'    => ['dashboard','auth.login','rp.management','admin.management','index'],
            'UserLeader'    => ['index'],
            'User'          => ['index']
        ];
        
        $admins = [
            'AdminiStrator' => ['admin'],
            'ManageUser'    => ['cosmos']
        ];
        
        $roles = [
            [
                'name' => 'AdminiStrator',
                'slug' => 'administrator',
            ],
            [
                'name' => 'ManageUser',
                'slug' => 'manage.admin',
            ],
            [
                'name' => 'UserLeader',
                'slug' => 'user.leader',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
            ]
        ];
        
        
        
        foreach ($roles as $role) {
            $id = DB::table('roles')->insertGetId($role);
            
            //
            if (isset($permissions[$role['name']])) {
                $slugs = $permissions[$role['name']];
                foreach ($slugs as $slug) {
                    $permission = DB::table('permissions')->where('slug', $slug)->first();
                    if ($permission) {
                        DB::table('role_permissions')->insert([
                            'role_id'       => $id,
                            'permission_id' => $permission->id
                        ]);
                    }
                }
            }
            
            //
            if (isset($admins[$role['name']])) {
                $accounts = $admins[$role['name']];
                foreach ($accounts as $account) {
                    $admin  = DB::table('admins')->where('account', $account)->first();
                    if ($admin) {
                        DB::table('role_admins')->insert([
                            'role_id'       => $id,
                            'admin_id' => $admin->id
                        ]);
                    }
                }
            }
            //
        }
    }
}
