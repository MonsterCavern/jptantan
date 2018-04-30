<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminGroupApiTest extends TestCase
{
    use MakeAdminGroupTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAdminGroup()
    {
        $adminGroup = $this->fakeAdminGroupData();
        $this->json('POST', '/api/v1/adminGroups', $adminGroup);

        $this->assertApiResponse($adminGroup);
    }

    /**
     * @test
     */
    public function testReadAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $this->json('GET', '/api/v1/adminGroups/'.$adminGroup->id);

        $this->assertApiResponse($adminGroup->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $editedAdminGroup = $this->fakeAdminGroupData();

        $this->json('PUT', '/api/v1/adminGroups/'.$adminGroup->id, $editedAdminGroup);

        $this->assertApiResponse($editedAdminGroup);
    }

    /**
     * @test
     */
    public function testDeleteAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $this->json('DELETE', '/api/v1/adminGroups/'.$adminGroup->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/adminGroups/'.$adminGroup->id);

        $this->assertResponseStatus(404);
    }
}
