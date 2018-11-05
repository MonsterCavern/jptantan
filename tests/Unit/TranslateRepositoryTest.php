<?php

namespace Tests\Unit;

use App;
use App\Models\Translate;
use App\Repositories\TranslateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\traits\MakeTranslateTrait;

class TranslateRepositoryTest extends TestCase
{
    use MakeTranslateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TranslateRepository
     */
    protected $translateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->translateRepo = App::make(TranslateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTranslate()
    {
        $translate = $this->fakeTranslateData();
        $createdTranslate = $this->translateRepo->create($translate);
        $createdTranslate = $createdTranslate->toArray();
        $this->assertArrayHasKey('id', $createdTranslate);
        $this->assertNotNull($createdTranslate['id'], 'Created Translate must have id specified');
        $this->assertNotNull(Translate::find($createdTranslate['id']), 'Translate with given id must be in DB');
        $this->assertModelData($translate, $createdTranslate);
    }

    /**
     * @test read
     */
    public function testReadTranslate()
    {
        $translate = $this->makeTranslate();
        $dbTranslate = $this->translateRepo->find($translate->id);
        $dbTranslate = $dbTranslate->toArray();
        $this->assertModelData($translate->toArray(), $dbTranslate);
    }

    /**
     * @test update
     */
    public function testUpdateTranslate()
    {
        $translate = $this->makeTranslate();
        $fakeTranslate = $this->fakeTranslateData();
        $updatedTranslate = $this->translateRepo->update($fakeTranslate, $translate->id);
        $this->assertModelData($fakeTranslate, $updatedTranslate->toArray());
        $dbTranslate = $this->translateRepo->find($translate->id);
        $this->assertModelData($fakeTranslate, $dbTranslate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTranslate()
    {
        $translate = $this->makeTranslate();
        $resp = $this->translateRepo->delete($translate->id);
        $this->assertTrue($resp);
        $this->assertNull(Translate::find($translate->id), 'Translate should not exist in DB');
    }
}
