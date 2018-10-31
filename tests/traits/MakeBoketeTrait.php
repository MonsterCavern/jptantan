<?php

namespace Tests\Traits;

use App;
use App\Models\Bokete;
use App\Repositories\BoketeRepository;
use App\Utils\Util;
use Faker\Factory as Faker;

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
        $theme      = $this->fakeBoketeData($boketeFields);

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
            'number'              => $fake->randomDigitNotNull,
            'url'                 => $fake->text,
            'content'             => Util::JsonEncode($fake->text),
            'ranting'             => $fake->randomDigitNotNull,
            'image'               => $fake->text,
            'source'              => $fake->text,
            'is_updated'          => $fake->randomDigitNotNull,
            'released_at'         => $fake->date('Y-m-d H:i:s'),
            'google_translate_id' => $fake->randomDigitNotNull,
            'baidu_translate_id'  => $fake->randomDigitNotNull,
            // 'updated_at'          => $fake->date('Y-m-d H:i:s'),
            // 'created_at'          => $fake->date('Y-m-d H:i:s'),
        ], $boketeFields);
    }
}
