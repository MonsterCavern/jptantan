<?php

use Faker\Factory as Faker;
use App\Models\Translate;
use App\Repositories\TranslateRepository;

trait MakeTranslateTrait
{
    /**
     * Create fake instance of Translate and save it in database
     *
     * @param array $translateFields
     * @return Translate
     */
    public function makeTranslate($translateFields = [])
    {
        /** @var TranslateRepository $translateRepo */
        $translateRepo = App::make(TranslateRepository::class);
        $theme = $this->fakeTranslateData($translateFields);
        return $translateRepo->create($theme);
    }

    /**
     * Get fake instance of Translate
     *
     * @param array $translateFields
     * @return Translate
     */
    public function fakeTranslate($translateFields = [])
    {
        return new Translate($this->fakeTranslateData($translateFields));
    }

    /**
     * Get fake data of Translate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTranslateData($translateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'target_id' => $fake->randomDigitNotNull,
            'target_type' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'content' => $fake->text,
            'tags' => $fake->text,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $translateFields);
    }
}
