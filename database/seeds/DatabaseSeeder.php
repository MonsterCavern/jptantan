<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(AdminPermissionsSeeder::class);
        $this->call(AdminGroupSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AdminMappingGroupSeeder::class);

        $this->call(RoleSeeder::class);

        $this->call(UserGroupSeeder::class);
        $this->call(UserSeeder::class);

        Artisan::call('crawler:bokete', [
            'type' => 'insert',
        ]);

        Artisan::call('crawler:bokete', [
            'type' => 'update',
        ]);

        Artisan::call('robot:google');
    }
}
