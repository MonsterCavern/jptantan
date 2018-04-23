<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminApiTest extends TestCase
{
    use MakeAdminTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAdmin()
    {
        $admin = $this->fakeAdminData();
        $this->json('POST', '/api/v1/admins', $admin);

        $this->assertApiResponse($admin);
    }

    /**
     * @test
     */
    public function testReadAdmin()
    {
        $admin = $this->makeAdmin();
        $this->json('GET', '/api/v1/admins/'.$admin->id);

        $this->assertApiResponse($admin->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAdmin()
    {
        $admin = $this->makeAdmin();
        $editedAdmin = $this->fakeAdminData();

        $this->json('PUT', '/api/v1/admins/'.$admin->id, $editedAdmin);

        $this->assertApiResponse($editedAdmin);
    }

    /**
     * @test
     */
    public function testDeleteAdmin()
    {
        $admin = $this->makeAdmin();
        $this->json('DELETE', '/api/v1/admins/'.$admin->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/admins/'.$admin->id);

        $this->assertResponseStatus(404);
    }
}
