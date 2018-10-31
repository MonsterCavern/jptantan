<?php

namespace Tests\Unit;

use App;
use App\Models\Bokete;
use App\Repositories\BoketeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\traits\MakeBoketeTrait;

class BoketeRepositoryTest extends TestCase
{
    use MakeBoketeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BoketeRepository
     */
    protected $boketeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->boketeRepo = App::make(BoketeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBokete()
    {
        $bokete        = $this->fakeBoketeData();
        $createdBokete = $this->boketeRepo->create($bokete);
        $createdBokete = $createdBokete->toArray();
        $this->assertArrayHasKey('id', $createdBokete);
        $this->assertNotNull($createdBokete['id'], 'Created Bokete must have id specified');
        $this->assertNotNull(Bokete::find($createdBokete['id']), 'Bokete with given id must be in DB');
        $this->assertModelData($bokete, $createdBokete);
    }

    /**
     * @test read
     */
    public function testReadBokete()
    {
        $bokete   = $this->makeBokete();
        $dbBokete = $this->boketeRepo->find($bokete->id);
        $dbBokete = $dbBokete->toArray();
        $this->assertModelData($bokete->toArray(), $dbBokete);
    }

    /**
     * @test update
     */
    public function testUpdateBokete()
    {
        $bokete        = $this->makeBokete();
        $fakeBokete    = $this->fakeBoketeData();
        $updatedBokete = $this->boketeRepo->update($fakeBokete, $bokete->id);
        $this->assertModelData($fakeBokete, $updatedBokete->toArray());
        $dbBokete = $this->boketeRepo->find($bokete->id);
        $this->assertModelData($fakeBokete, $dbBokete->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBokete()
    {
        $bokete = $this->makeBokete();
        $resp   = $this->boketeRepo->delete($bokete->id);
        $this->assertTrue($resp);
        $this->assertNull(Bokete::find($bokete->id), 'Bokete should not exist in DB');
    }
}
