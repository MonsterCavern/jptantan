<?php

use Faker\Factory as Faker;
use App\Models\Bokete;
use App\Repositories\BoketeRepository;

trait MakeBoketeTrait
{
    /**
     * Create fake instance of Bokete and save it in database
     *
     * @param array $boketeFields
     * @return Bokete
     */
    public function makeBokete($boketeFields = [])
    {
        /** @var BoketeRepository $boketeRepo */
        $boketeRepo = App::make(BoketeRepository::class);
        $theme = $this->fakeBoketeData($boketeFields);
        return $boketeRepo->create($theme);
    }

    /**
     * Get fake instance of Bokete
     *
     * @param array $boketeFields
     * @return Bokete
     */
    public function fakeBokete($boketeFields = [])
    {
        return new Bokete($this->fakeBoketeData($boketeFields));
    }

    /**
     * Get fake data of Bokete
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBoketeData($boketeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'number' => $fake->randomDigitNotNull,
            'url' => $fake->text,
            'imgurl' => $fake->text,
            'content' => $fake->text,
            'ranting' => $fake->randomDigitNotNull,
            'source' => $fake->text,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $boketeFields);
    }
}
