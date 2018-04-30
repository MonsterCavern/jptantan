<?php

use App\Models\AdminGroup;
use App\Repositories\AdminGroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminGroupRepositoryTest extends TestCase
{
    use MakeAdminGroupTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdminGroupRepository
     */
    protected $adminGroupRepo;

    public function setUp()
    {
        parent::setUp();
        $this->adminGroupRepo = App::make(AdminGroupRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAdminGroup()
    {
        $adminGroup = $this->fakeAdminGroupData();
        $createdAdminGroup = $this->adminGroupRepo->create($adminGroup);
        $createdAdminGroup = $createdAdminGroup->toArray();
        $this->assertArrayHasKey('id', $createdAdminGroup);
        $this->assertNotNull($createdAdminGroup['id'], 'Created AdminGroup must have id specified');
        $this->assertNotNull(AdminGroup::find($createdAdminGroup['id']), 'AdminGroup with given id must be in DB');
        $this->assertModelData($adminGroup, $createdAdminGroup);
    }

    /**
     * @test read
     */
    public function testReadAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $dbAdminGroup = $this->adminGroupRepo->find($adminGroup->id);
        $dbAdminGroup = $dbAdminGroup->toArray();
        $this->assertModelData($adminGroup->toArray(), $dbAdminGroup);
    }

    /**
     * @test update
     */
    public function testUpdateAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $fakeAdminGroup = $this->fakeAdminGroupData();
        $updatedAdminGroup = $this->adminGroupRepo->update($fakeAdminGroup, $adminGroup->id);
        $this->assertModelData($fakeAdminGroup, $updatedAdminGroup->toArray());
        $dbAdminGroup = $this->adminGroupRepo->find($adminGroup->id);
        $this->assertModelData($fakeAdminGroup, $dbAdminGroup->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAdminGroup()
    {
        $adminGroup = $this->makeAdminGroup();
        $resp = $this->adminGroupRepo->delete($adminGroup->id);
        $this->assertTrue($resp);
        $this->assertNull(AdminGroup::find($adminGroup->id), 'AdminGroup should not exist in DB');
    }
}
