<?php

use Faker\Factory as Faker;
use App\Models\AdminGroup;
use App\Repositories\AdminGroupRepository;

trait MakeAdminGroupTrait
{
    /**
     * Create fake instance of AdminGroup and save it in database
     *
     * @param array $adminGroupFields
     * @return AdminGroup
     */
    public function makeAdminGroup($adminGroupFields = [])
    {
        /** @var AdminGroupRepository $adminGroupRepo */
        $adminGroupRepo = App::make(AdminGroupRepository::class);
        $theme = $this->fakeAdminGroupData($adminGroupFields);
        return $adminGroupRepo->create($theme);
    }

    /**
     * Get fake instance of AdminGroup
     *
     * @param array $adminGroupFields
     * @return AdminGroup
     */
    public function fakeAdminGroup($adminGroupFields = [])
    {
        return new AdminGroup($this->fakeAdminGroupData($adminGroupFields));
    }

    /**
     * Get fake data of AdminGroup
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAdminGroupData($adminGroupFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $adminGroupFields);
    }
}
