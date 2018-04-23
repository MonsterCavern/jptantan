<?php

use Faker\Factory as Faker;
use App\Models\Permission;
use App\Repositories\PermissionRepository;

trait MakePermissionTrait
{
    /**
     * Create fake instance of Permission and save it in database
     *
     * @param array $permissionFields
     * @return Permission
     */
    public function makePermission($permissionFields = [])
    {
        /** @var PermissionRepository $permissionRepo */
        $permissionRepo = App::make(PermissionRepository::class);
        $theme = $this->fakePermissionData($permissionFields);
        return $permissionRepo->create($theme);
    }

    /**
     * Get fake instance of Permission
     *
     * @param array $permissionFields
     * @return Permission
     */
    public function fakePermission($permissionFields = [])
    {
        return new Permission($this->fakePermissionData($permissionFields));
    }

    /**
     * Get fake data of Permission
     *
     * @param array $postFields
     * @return array
     */
    public function fakePermissionData($permissionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'slug' => $fake->word,
            'prifix' => $fake->word,
            'http_method' => $fake->word,
            'http_path' => $fake->text,
            'read_only' => $fake->randomDigitNotNull,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $permissionFields);
    }
}