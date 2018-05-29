<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TranslateApiTest extends TestCase
{
    use MakeTranslateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTranslate()
    {
        $translate = $this->fakeTranslateData();
        $this->json('POST', '/api/v1/translates', $translate);

        $this->assertApiResponse($translate);
    }

    /**
     * @test
     */
    public function testReadTranslate()
    {
        $translate = $this->makeTranslate();
        $this->json('GET', '/api/v1/translates/'.$translate->id);

        $this->assertApiResponse($translate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTranslate()
    {
        $translate = $this->makeTranslate();
        $editedTranslate = $this->fakeTranslateData();

        $this->json('PUT', '/api/v1/translates/'.$translate->id, $editedTranslate);

        $this->assertApiResponse($editedTranslate);
    }

    /**
     * @test
     */
    public function testDeleteTranslate()
    {
        $translate = $this->makeTranslate();
        $this->json('DELETE', '/api/v1/translates/'.$translate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/translates/'.$translate->id);

        $this->assertResponseStatus(404);
    }
}
