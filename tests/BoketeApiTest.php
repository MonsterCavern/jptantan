<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoketeApiTest extends TestCase
{
    use MakeBoketeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBokete()
    {
        $bokete = $this->fakeBoketeData();
        $this->json('POST', '/api/v1/boketes', $bokete);

        $this->assertApiResponse($bokete);
    }

    /**
     * @test
     */
    public function testReadBokete()
    {
        $bokete = $this->makeBokete();
        $this->json('GET', '/api/v1/boketes/'.$bokete->id);

        $this->assertApiResponse($bokete->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBokete()
    {
        $bokete = $this->makeBokete();
        $editedBokete = $this->fakeBoketeData();

        $this->json('PUT', '/api/v1/boketes/'.$bokete->id, $editedBokete);

        $this->assertApiResponse($editedBokete);
    }

    /**
     * @test
     */
    public function testDeleteBokete()
    {
        $bokete = $this->makeBokete();
        $this->json('DELETE', '/api/v1/boketes/'.$bokete->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/boketes/'.$bokete->id);

        $this->assertResponseStatus(404);
    }
}
