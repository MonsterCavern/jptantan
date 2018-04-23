<?php

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminRepositoryTest extends TestCase
{
    use MakeAdminTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdminRepository
     */
    protected $adminRepo;

    public function setUp()
    {
        parent::setUp();
        $this->adminRepo = App::make(AdminRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAdmin()
    {
        $admin = $this->fakeAdminData();
        $createdAdmin = $this->adminRepo->create($admin);
        $createdAdmin = $createdAdmin->toArray();
        $this->assertArrayHasKey('id', $createdAdmin);
        $this->assertNotNull($createdAdmin['id'], 'Created Admin must have id specified');
        $this->assertNotNull(Admin::find($createdAdmin['id']), 'Admin with given id must be in DB');
        $this->assertModelData($admin, $createdAdmin);
    }

    /**
     * @test read
     */
    public function testReadAdmin()
    {
        $admin = $this->makeAdmin();
        $dbAdmin = $this->adminRepo->find($admin->id);
        $dbAdmin = $dbAdmin->toArray();
        $this->assertModelData($admin->toArray(), $dbAdmin);
    }

    /**
     * @test update
     */
    public function testUpdateAdmin()
    {
        $admin = $this->makeAdmin();
        $fakeAdmin = $this->fakeAdminData();
        $updatedAdmin = $this->adminRepo->update($fakeAdmin, $admin->id);
        $this->assertModelData($fakeAdmin, $updatedAdmin->toArray());
        $dbAdmin = $this->adminRepo->find($admin->id);
        $this->assertModelData($fakeAdmin, $dbAdmin->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAdmin()
    {
        $admin = $this->makeAdmin();
        $resp = $this->adminRepo->delete($admin->id);
        $this->assertTrue($resp);
        $this->assertNull(Admin::find($admin->id), 'Admin should not exist in DB');
    }
}
