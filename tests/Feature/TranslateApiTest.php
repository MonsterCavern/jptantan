<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\traits\MakeTranslateTrait;

class TranslateApiTest extends TestCase
{
    use MakeTranslateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTranslate()
    {
        $translate = $this->fakeTranslateData();
        $this->json('POST', '/api/translates', $translate);

        $this->assertApiResponse($translate);
    }

    /**
     * @test
     */
    public function testReadTranslate()
    {
        $translate = $this->makeTranslate();
        $this->json('GET', '/api/translates/'.$translate->id);

        $this->assertApiResponse($translate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTranslate()
    {
        $translate = $this->makeTranslate();
        $editedTranslate = $this->fakeTranslateData();

        $this->json('PUT', '/api/translates/'.$translate->id, $editedTranslate);

        $this->assertApiResponse($editedTranslate);
    }

    /**
     * @test
     */
    public function testDeleteTranslate()
    {
        $translate = $this->makeTranslate();
        $this->json('DELETE', '/api/translates/'.$translate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/translates/'.$translate->id);

        $this->assertResponseStatus(404);
    }
}
